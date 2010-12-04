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
     "Albanian",
     "Arabic",
    "Assamese",
    "Azerbaijani Cyrillic",
    "Azerbaijani Latin",
    "Belarusian",
    "Belgian",
    "Bengali",
    "Bosnian",
    "Bulgarian BDS",
    "Bulgarian Phonetic",
    "Burmese",
    "Canadian French",
    "Chinese Bopomofo IME",
    "Chinese Cangjie IME",
    "Croatian",
    "Czech",
    "Danish",
    "Dari",
    "Devanagari",
    "Dingbats",
    "Divehi",
    "Dutch",
    "Dvorak",
    "Eastern Armenian",
    "Estonian",
    "Faeroese",
    "Farsi",
    "Finnish",
    "French",
    "Georgian",
    "German",
    "Greek",
    "Gujarati",
    "Hebrew",
    "Hindi",
    "Hungarian",
    "Icelandic",
    "Irish / Gaelic",
    "Italian",
    "Japanese Hiragana/Katakana",
    "Kannada",
    "Kazakh",
    "Khmer",
    "Korean",
    "Kurdish",
    "Kyrgyz",
    "Latvian",
    "Lithuanian",
    "Macedonian Cyrillic",
    "Malayalam",
    "Maltese 48",
    "Marathi",
    "Misc. Symbols",
    "Mongolian Cyrillic",
    "Norwegian",
    "Pashto",
    "Pinyin",
    "Polish (214)",
    "Polish Programmers",
    "Portuguese",
    "Portuguese (Brazil)",
    "Punjabi (Gurmukhi)",
    "Romanian",
    "Russian",
    "Serbian Cyrillic",
    "Serbian Latin",
    "Slovak",
    "Slovenian",
    "Spanish",
    "Swedish",
    "Swiss French",
    "Swiss German",
    "Syriac",
    "Tamil",
    "Tatar",
    "Telugu",
    "Thai Kedmanee",
    "Thai Pattachote",
    "Turkish F",
    "Turkish Q",
    "Ukrainian",
    "United Kingdom",
    "Urdu",
    "US International",
    "US Standard",
    "Uzbek Cyrillic",
    "Vietnamese",
    "Western Armenian"
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

function getSelected(options) {

var lang = "";
  for(var i=1; i < options.length; i++) {
     if(options[i].selected) {
        lang += options[i].value + ';;';
     }
  }
  
  return lang.replace(/;;$/, "");

}

function setKeyboard(setkb) {
    
    if(setkb) { 
        var oSelect = document.getElementById("vki_names");
        var lang = getSelected(oSelect.options);
     
        if(!lang) {
               if(!confirm(
                 "You haven\'t selected a language for the keyboard. The virtual keyboard will not load."
                 + "\nClick OK to Exit, Click Cancel to Return to the Selection menu."
                 ))
                 return;
              else window.close();
        }
               
        //  alert(lang);

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

  options[0] = new Option('<?php button_text("Select initial keyboard language", "sel_none")?>', 'none',false);

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
<select id = "vki_names" multiple size='12'></select><br />
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
