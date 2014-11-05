<?php
function xmlObjToArr($obj) {

/**
 * convert xml objects to array
 * function from http://php.net/manual/pt_BR/book.simplexml.php
 * as posted by xaviered at gmail dot com 17-May-2012 07:00
 * NOTE: return array() ('name'=>$name) commented out; not needed to parse xlsx
 */
        $namespace = $obj->getDocNamespaces(true);
        $namespace[NULL] = NULL;
       
        $children = array();
        $attributes = array();
        $name = strtolower((string)$obj->getName());
       
        $text = trim((string)$obj);
        if( strlen($text) <= 0 ) {
            $text = NULL;
        }
       
        // get info for all namespaces
        if(is_object($obj)) {
            foreach( $namespace as $ns=>$nsUrl ) {
                // atributes
                $objAttributes = $obj->attributes($ns, true);
                foreach( $objAttributes as $attributeName => $attributeValue ) {
                    $attribName = strtolower(trim((string)$attributeName));
                    $attribVal = trim((string)$attributeValue);
                    if (!empty($ns)) {
                        $attribName = $ns . ':' . $attribName;
                    }
                    $attributes[$attribName] = $attribVal;
                }
               
                // children
                $objChildren = $obj->children($ns, true);
                foreach( $objChildren as $childName=>$child ) {
                    $childName = strtolower((string)$childName);
                    if( !empty($ns) ) {
                        $childName = $ns.':'.$childName;
                    }
                    $children[$childName][] = xmlObjToArr($child);
                }
            }
        }
         
        return array(
           // name not needed for xlsx
           // 'name'=>$name,
            'text'=>$text,
            'attributes'=>$attributes,
            'children'=>$children
        );
    }
	
	
function my_fputcsv($handle, $fields, $delimiter = ',', $enclosure = '"', $escape = '\\') {
/**
 * write array to csv file
 * enhanced fputcsv found at http://php.net/manual/en/function.fputcsv.php
 * posted by Hiroto Kagotani 28-Apr-2012 03:13
 * used in lieu of native PHP fputcsv() resolves PHP backslash doublequote bug
 * !!!!!! To resolve issues with escaped characters breaking converted CSV, try this:
 * Kagotani: "It is compatible to fputcsv() except for the additional 5th argument $escape, 
 * which has the same meaning as that of fgetcsv().  
 * If you set it to '"' (double quote), every double quote is escaped by itself."
 */
  $first = 1;
  foreach ($fields as $field) {
    if ($first == 0) fwrite($handle, ",");

    $f = str_replace($enclosure, $enclosure.$enclosure, $field);
    if ($enclosure != $escape) {
      $f = str_replace($escape.$enclosure, $escape, $f);
    }
    if (strpbrk($f, " \t\n\r".$delimiter.$enclosure.$escape) || strchr($f, "\000")) {
      fwrite($handle, $enclosure.$f.$enclosure);
    } else {
      fwrite($handle, $f);
    }

    $first = 0;
  }
  fwrite($handle, "\n");
}


/**
 * Delete unpacked files from server
 */ 
function cleanUp($dir) {
    $tempdir = opendir($dir);
    while(false !== ($file = readdir($tempdir))) {
        if($file != "." && $file != "..") {
             if(is_dir($dir.$file)) {
                chdir('.');
                cleanUp($dir.$file.'/');
                rmdir($dir.$file);
            }
            else
                unlink($dir.$file);
        }
    }
    closedir($tempdir);
}
?>