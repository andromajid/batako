<?php

/**
  ###############################################
  ####                                       ####
  ####    Author : Harish Chauhan            ####
  ####    Date   : 31 Dec,2004               ####
  ####    Updated:                           ####
  ####                                       ####
  ###############################################

 */
/**
 * Class is used for save the data into microsoft excel format.
 * It takes data into array or you can write data column vise.
 */

/**
  default:
  mso-number-format:General

  mso-number-format:"0" No Decimals
  mso-number-format:"0\.00" 2 Decimals
  mso-number-format:"mm\/dd\/yy" Date format
  mso-number-format:"m\/d\/yy\ h\:mm\ AM\/PM" D -T AMPM
  mso-number-format:"Short Date" 05/06/-2008
  mso-number-format:"Medium Date" 05-jan-2008
  mso-number-format:"Short Time" 8:67
  mso-number-format:"Medium Time" 8:67 am
  mso-number-format:"Long Time"  8:67:25:00
  mso-number-format:"Percent" Percent - two decimals
  mso-number-format:"0\.E+00" Scientific Notation
  mso-number-format:"\@" Text
  mso-number-format:"\#\ ???\/???" Fractions - up to 3 digits (312/943)
  mso-number-format:"\0022£\0022\#\,\#\#0\.00" £12.76
  mso-number-format:"\#\,\#\#0\.00_ \;\[Red\]\-\#\,\#\#0\.00\ " 2 decimals, negative numbers in red and signed (1.86   -1.66)
  mso-number-format:”\\#\\,\\#\\#0\\.00_\\)\\;\\[Black\\]\\\\(\\#\\,\\#\\#0\\.00\\\\)”   Accounting Format –5,(5)
 */
Class excel {

    var $fp = null;
    var $error;
    var $download, $file;
    public $content = '';
    var $state = "CLOSED";
    var $newRow = false;

    /*
     * @Params : $file  : file name of excel file to be created.
     * @param boolean $download akan kah di force download
     * @Return : On Success Valid File Pointer to file
     * 			On Failure return false
     */

    function __construct($file = "", $download = true) {
        $this->download = $download;
        $this->file = $file;
        $arr_file = explode('/', $file);
        $count_file = count($arr_file);
        $this->file = $arr_file[$count_file - 1];
        if ($this->download) {
            $this->openDownload();
        } else {
            return $this->open($file);
        }
    }

    /**
     * @return void
     */
    public function openDownload() {
        $this->content .= $this->GetHeader();
    }

    /*
     * @Params : $file  : file name of excel file to be created.
     * 			if you are using file name with directory i.e. test/myFile.xls
     * 			then the directory must be existed on the system and have permissioned properly
     * 			to write the file.
     * @Return : On Success Valid File Pointer to file
     * 			On Failure return false
     */

    function open($file) {
        if ($this->state != "CLOSED") {
            $this->error = "Error : Another file is opend .Close it to save the file";
            return false;
        }

        if (!empty($file)) {
            $this->fp = @fopen($file, "w+");
        } else {
            $this->error = "Usage : New ExcelWriter('fileName')";
            return false;
        }
        if ($this->fp == false) {
            $this->error = "Error: Unable to open/create File.You may not have permmsion to write the file.";
            return false;
        }
        $this->state = "OPENED";
        fwrite($this->fp, $this->GetHeader());
        return $this->fp;
    }

    function close() {
        ob_start();
        if ($this->state != "OPENED") {
            $this->error = "Error : Please open the file.";
            //return false;
        }
        
        if ($this->newRow) {
            if ($this->download) {
                $this->content .= "</tr>";
            } else {
                fwrite($this->fp, "</tr>");
            }
            $this->newRow = false;
        }

        if ($this->download) {
            $this->content .= $this->GetFooter();
            $this->state = "CLOSED";
            header("Content-Description: File Transfer");
            header("Content-type: application/vnd.ms-excel");
            header('Content-Disposition: attachment; filename="'.$this->file.'"');
            header('Content-Length: ' . strlen($this->content));
            header('Connection: close');
            //var_dump($this->content);
            echo $this->content;
        } else {
            echo 'dasdasd';
            fwrite($this->fp, $this->GetFooter());
            fclose($this->fp);
            $this->state = "CLOSED";
        }
        return;
    }

    /**
     * @Params : Void
     *  @return : Void
     * This function write the header of Excel file.
     */
    function GetHeader() {
        $header = <<<EOH
				<html xmlns:o="urn:schemas-microsoft-com:office:office"
				xmlns:x="urn:schemas-microsoft-com:office:excel"
				xmlns="http://www.w3.org/TR/REC-html40">

				<head>
				<meta http-equiv=Content-Type content="text/html; charset=us-ascii">
				<meta name=ProgId content=Excel.Sheet>
				<!--[if gte mso 9]><xml>
				 <o:DocumentProperties>
				  <o:LastAuthor>File</o:LastAuthor>
				  <o:LastSaved>2005-01-02T07:46:23Z</o:LastSaved>
				  <o:Version>10.2625</o:Version>
				 </o:DocumentProperties>
				 <o:OfficeDocumentSettings>
				  <o:DownloadComponents/>
				 </o:OfficeDocumentSettings>
				</xml><![endif]-->
				<style>
				<!--table
					{mso-displayed-decimal-separator:"\.";
					mso-displayed-thousand-separator:"\,";}
				@page
					{margin:1.0in .75in 1.0in .75in;
					mso-header-margin:.5in;
					mso-footer-margin:.5in;}
				tr
					{mso-height-source:auto;}
				col
					{mso-width-source:auto;}
				br
					{mso-data-placement:same-cell;}
				.style0
					{mso-number-format:"\@";
					text-align:general;
					vertical-align:bottom;
					white-space:nowrap;
					mso-rotate:0;
					mso-background-source:auto;
					mso-pattern:auto;
					color:windowtext;
					font-size:10.0pt;
					font-weight:400;
					font-style:normal;
					text-decoration:none;
					font-family:Arial;
					mso-generic-font-family:auto;
					mso-font-charset:0;
					border:none;
					mso-protection:locked visible;
					mso-style-name:Normal;
					mso-style-id:0;}
				td
					{mso-style-parent:style0;
					padding-top:1px;
					padding-right:1px;
					padding-left:1px;
					mso-ignore:padding;
					color:windowtext;
					font-size:10.0pt;
					font-weight:400;
					font-style:normal;
					text-decoration:none;
					font-family:Arial;
					mso-generic-font-family:auto;
					mso-font-charset:0;
					mso-number-format:"\@";
					text-align:general;
					vertical-align:bottom;
					border:none;
					mso-background-source:auto;
					mso-pattern:auto;
					mso-protection:locked visible;
					white-space:nowrap;
					mso-rotate:0;}
				.xl24
					{mso-style-parent:style0;
					white-space:normal;}
				-->
				</style>
				<!--[if gte mso 9]><xml>
				 <x:ExcelWorkbook>
				  <x:ExcelWorksheets>
				   <x:ExcelWorksheet>
					<x:Name>File</x:Name>
					<x:WorksheetOptions>
					 <x:Selected/>
					 <x:ProtectContents>False</x:ProtectContents>
					 <x:ProtectObjects>False</x:ProtectObjects>
					 <x:ProtectScenarios>False</x:ProtectScenarios>
					</x:WorksheetOptions>
				   </x:ExcelWorksheet>
				  </x:ExcelWorksheets>
				  <x:WindowHeight>10005</x:WindowHeight>
				  <x:WindowWidth>10005</x:WindowWidth>
				  <x:WindowTopX>120</x:WindowTopX>
				  <x:WindowTopY>135</x:WindowTopY>
				  <x:ProtectStructure>False</x:ProtectStructure>
				  <x:ProtectWindows>False</x:ProtectWindows>
				 </x:ExcelWorkbook>
				</xml><![endif]-->
				</head>

				<body link=blue vlink=purple>
				<table x:str border=0 cellpadding=0 cellspacing=0 style='border-collapse: collapse;table-layout:fixed;'>
EOH;
        return $header;
    }

    function GetFooter() {
        return "</table></body></html>";
    }

    /**
     * @Params : $line_arr: An valid array
     * @Return : Void
     */
    function writeLine($line_arr) {
        if ($this->state != "OPENED") {
            $this->error = "Error : Please open the file.";
            //return false;
        }
        if (!is_array($line_arr)) {
            $this->error = "Error : Argument is not valid. Supply an valid Array.";
            //return false;
        }
        if ($this->download) {
            $this->content .= "<tr>";
            foreach ($line_arr as $col) {
                $this->content .= "<td class=xl24 width=64 >$col</td>";
            }
            $this->content .= "</tr>";
        } else {
            fwrite($this->fp, "<tr>");
            foreach ($line_arr as $col) {
                fwrite($this->fp, "<td class=xl24 width=64 >$col</td>");
            }
            fwrite($this->fp, "</tr>");
        }
    }

    /*
     * @Params : Void
     * @Return : Void
     */

    function writeRow() {
        if ($this->state != "OPENED") {
            $this->error = "Error : Please open the file.";
            return false;
        }
        if ($this->newRow == false) {
            if ($this->download) {
                $this->content .= "<tr>";
            } else {
                fwrite($this->fp, "<tr>");
            }
        } else {
            if ($this->download) {
                $this->content .= "</tr><tr>";
            } else {
                fwrite($this->fp, "</tr><tr>");
            }
        }
        $this->newRow = true;
    }

    /*
     * @Params : $value : Coloumn Value
     * @Return : Void
     */

    function writeCol($value) {
        if ($this->state != "OPENED") {
            $this->error = "Error : Please open the file.";
            return false;
        }
        if ($this->download) {
            $this->content .= "<td class=xl24 width=64 >$value</td>";
        } else {
            fwrite($this->fp, "<td class=xl24 width=64 >$value</td>");
        }
    }

}

?>