<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
/**
 * vkeyboard plugin initializer and unloader
 * @author Myron Turner <turnermm02@shaw.ca>
*/
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../../../').'/');
define ('DOKU_CONF', DOKU_INC . 'conf/');
   
if(file_exists(DOKU_CONF . 'dokuwiki.php')) {
   include(DOKU_CONF . 'dokuwiki.php');
}

if(file_exists(DOKU_CONF . 'local.php')) {
   include(DOKU_CONF . 'local.php');
}

@include('../lang/en/lang.php');
if($conf['lang'] != 'en') {
    $local_file = '../lang/' . $conf['lang'] . '/lang.php';    
    if(file_exists($local_file)) {
       include($local_file);
    }
}
function button_text($default, $item) {
  global $lang;
  if(isset($lang[$item])) {
      echo $lang[$item];
  }
  else echo $default;
}
?>

<HTML>
<HEAD>
<Title></Title>
<script type="text/javascript">

var vki_languages = new Array(    
    "Arabic",
    "Assamese",
    "Azerbaijani Cyrillic",
    "Azerbaijani Latin",
    "Belarusian",
    "Belgian",
    "Bulgarian Phonetic",
    "Bulgarian BDS",
    "Bengali",
    "Bosnian",
    "Canadian French",
    "Czech",
    "Danish",
    "German",
    "Dingbats",
    "Divehi",
    "Dvorak",
    "Greek",
    "Estonian",
    "Spanish",
    "Dari",
    "Farsi",
    "Faeroese",
    "French",
    "Irish / Gaelic",
    "Gujarati",
    "Hebrew",
    "Devanagari",
    "Hindi",
    "Croatian",
    "Western Armenian",
    "Eastern Armenian",
    "Icelandic",
    "Italian",
    "Japanese Hiragana/Katakana",
    "Georgian",
    "Kazakh",
    "Khmer",
    "Kannada",
    "Korean",
    "Kurdish",
    "Kyrgyz",
    "Latvian",
    "Lithuanian",
    "Hungarian",
    "Maltese 48",
    "Macedonian Cyrillic",
    "Malayalam",
    "Misc. Symbols",
    "Mongolian Cyrillic",
    "Marathi",
    "Burmese",
    "Dutch",
    "Norwegian",
    "Pashto",
    "Punjabi (Gurmukhi)",
    "Pinyin",
    "Polish (214)",
    "Polish Programmers",
    "Portuguese (Brazil)",
    "Portuguese",
    "Romanian",
    "Russian",
    "Swiss German",
    "Albanian",
    "Slovak",
    "Slovenian",
    "Serbian Cyrillic",
    "Serbian Latin",
    "Finnish",
    "Swedish",
    "Swiss French",
    "Syriac",
    "Tamil",
    "Telugu",
    "Vietnamese",
    "Thai Kedmanee",
    "Thai Pattachote",
    "Tatar",
    "Turkish F",
    "Turkish Q",
    "Ukrainian",
    "United Kingdom",
    "Urdu",
    "US Standard",
    "US International",
    "Uzbek Cyrillic",
    "Chinese Bopomofo IME",
    "Chinese Cangjie IME"
);

function getCookieValue() {

var value;
    var allcookies = document.cookie;
    var pos = allcookies.indexOf('VKB');
    
    if(pos != -1) {  
       var start = pos+3;
       var end = allcookies.indexOf(';', start);
       if(end == -1) end = allcookies.length;
       value = allcookies.substring(start,end);
    }
    if(value) {
         return('off' + '-' + value);
    }
    else return('off' + '-' + 'Greek');
}

function setKeyboard(setkb) {
    var lang;
    if(setkb) { 
        var oSelect = document.getElementById("vki_names");
        var index = oSelect.selectedIndex;
        if(index == 0  || !index) {
               if(!confirm(
                 "You haven\'t selected a language for the keyboard. The virtual keyboard will not load."
                 + "\nClick OK to Exit, Click Cancel to Return to the Selection menu."
                 ))
                 return;
              else window.close();
        }
        lang =  oSelect.options[index].value;
    }
    else {
      lang = getCookieValue();
    }
    var form = opener.document.getElementById('dw__editform');
    var inputEl = opener.document.createElement('input');
    inputEl.type = 'hidden';
    inputEl.id = 'vkb';
    inputEl.name = 'vkb';
    inputEl.value = lang;
    form.appendChild(inputEl);
    window.close();
}

window.onload = function() {
  var options = document.getElementById("vki_names").options;

  options[0] = new Option('<?php button_text("Select initial keyboard language", "sel_none")?>', 'none',true);

  for(var i=1; i<vki_languages.length;i++) {
    options[i] =  new Option(vki_languages[i-1], vki_languages[i-1], false);     
  }
  
}
</script>
<style type="text/css">
p, .nine_pt, option, button { font-size: 9pt; }
body { padding-left: 8px; padding-right:8px; }
</style>

</HEAD>
<BODY>
<h3><?php button_text("Virtual Keyboard",'header') ?></h3>
<p id="about">
<?php button_text( 'To initialize the virtual keyboard, select the intial language
which the keyboard will display, then click the "Initialize Keyboad" button.
Once the keyboard is in  place, you can select any other
available language from its menu. You 
may also unload the virtual keyboard by clicking the "Unload Keyboard" button.
Clicking "Exit" closes this window without any action.',"about"); ?>
</p>

<p id="warn">
<?php button_text('After this window closes you must click either "Save" or "Cancel" in the editing window. If you click "Preview" your changes will be lost.', "warn"); ?>
</p>


<form name="vki_getnames">
<table cellspacing='4'>
<tr><td>
<select id = "vki_names"></select><br />
<tr><td>
<input type='submit'class='nine_pt' value = "<?php button_text('Initialize Keyboad', 'button_ini') ?>" onclick="setKeyboard(true)">
&nbsp;&nbsp;
<input type='button' class='nine_pt' value="<?php button_text('Unload Keyboard', 'button_unload') ?>" onclick="setKeyboard(false)">
&nbsp;&nbsp;
<input type='button' class='nine_pt' value="<?php button_text('Exit', 'button_exit') ?>" onclick="window.close()">&nbsp;&nbsp;

</table>
</form>
</BODY>
</HTML>
