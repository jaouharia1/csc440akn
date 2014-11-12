<?php
		file_put_contents("uploadFiles/sr-2008.xlsx", file_get_contents("http://www.cincinnati-oh.gov/cityofcincinnati/assets/File/data/service_request_2008.xlsx"));
		echo "Downloading 2008 Service Request Records...<br><br>";
		file_put_contents("uploadFiles/sr-2009.xlsx", file_get_contents("http://www.cincinnati-oh.gov/cityofcincinnati/assets/File/data/service_request_2009.xlsx"));
		echo "Downloading 2009 Service Request Records...<br><br>";
		file_put_contents("uploadFiles/sr-2010.xlsx", file_get_contents("http://www.cincinnati-oh.gov/cityofcincinnati/assets/File/data/service_request_2010.xlsx"));
		echo "Downloading 2010 Service Request Records...<br><br>";
		file_put_contents("uploadFiles/sr-2011.xlsx", file_get_contents("http://www.cincinnati-oh.gov/cityofcincinnati/assets/File/data/service_request_2011.xlsx"));
		echo "Downloading 2011 Service Request Records...<br><br>";
		file_put_contents("uploadFiles/sr-2012.xlsx", file_get_contents("http://www.cincinnati-oh.gov/cityofcincinnati/assets/File/data/service_request_2012.xlsx"));
		echo "Downloading 2012 Service Request Records...<br><br>";
		file_put_contents("uploadFiles/sr-2013.xlsx", file_get_contents("http://www.cincinnati-oh.gov/cityofcincinnati/assets/File/data/service_request_2013.xlsx"));
		echo "Downloading 2013 Service Request Records...<br><br>";

		echo "ALL RECORDS DOWNLOADED";
?>