<?php
/*
  Plugin Docs: https://docs.joomla.org/J3.x:Creating_a_Plugin_for_Joomla
     Examples: https://github.com/joomla/joomla-cms/tree/staging/plugins
   class name: Plg<Group><Name> as set in manifest.xml
  JPlugin API: https://api.joomla.org/cms-3/classes/JPlugin.html
      Events : https://docs.joomla.org/Plugin/Events
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once(__DIR__.'/assets/kint/Kint.class.php');
jimport( 'joomla.plugin.plugin' );

class PlgSystemCustom extends JPlugin {
	function onAfterInitialise(){
    $kintOutput = $this->params->get('kintOutput');
    if($kintOutput && $kintOutput === 'hide'){
      Kint::enabled(false);
    }
  }
}
