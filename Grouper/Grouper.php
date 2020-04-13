<?php
/*
  Plugin Docs: https://docs.joomla.org/J3.x:Creating_a_Plugin_for_Joomla
     Examples: https://github.com/joomla/joomla-cms/tree/staging/plugins
   class name: Plg<Group><Name> as set in manifest.xml
  JPlugin API: https://api.joomla.org/cms-3/classes/JPlugin.html
      Events : https://docs.joomla.org/Plugin/Events
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );
jimport( 'joomla.user.helper' );

class PlgUserGrouper extends JPlugin {
  function array_values_identical($a, $b)
  {
    $x = array_values($a);
    $y = array_values($b);

    sort($x);
    sort($y);

    JLog::add(implode("|", $x));
    JLog::add(implode("|", $y));
    JLog::add($x == $y ? 'true' : 'false');

    return $x == $y;
  }

  public function onUserAfterSave($data, $isnew, $success, $msg)
  {
    JLog::add('Avvio la classificazione dell\'utente.');
    
    // if ($isNew)
    if(true)
    {
      // Get a db connection.
			$db = JFactory::getDbo();
			// Create a new query object.
			$query = $db->getQuery(true);
					
			$query
					->select($db->quoteName(array('field_id', 'item_id', 'value')))
					->from($db->quoteName('r9ofn_fields_values'))
					->where($db->quoteName('item_id') . ' LIKE '. $db->quote($data['id']))
					->order('field_id ASC');
					
			// Reset the query using our newly populated query object.
			$db->setQuery($query);
			// Load the results as a list of stdClass objects
      $results = $db->loadObjectList();

      JLog::add('L\'utente è di tipo '. $results[1]->value .'.');

      switch ($results[1]->value)
      {
        case "base":
        // Tipologia di utenti: 15.
        if(in_array ( 15, JUserHelper::getUserGroups($data['id'])))
        {
          JLog::add('L\'utente esiste già, e i gruppi sono ok.');
          break;
        } else {
          JLog::add('L\'utente esiste, ma devo cambiare i gruppi.');
          JUserHelper::setUserGroups($data['id'], array(15, 2));
          break;
        }


        case "medic":
        // Tipologia di utenti: 10.
        if(in_array ( 10, JUserHelper::getUserGroups($data['id'])))
        {
          JLog::add('L\'utente esiste già, e i gruppi sono ok.');
          break;
        } else {
          JLog::add('L\'utente esiste, ma devo cambiare i gruppi.');
          JUserHelper::setUserGroups($data['id'], array(10, 2));
          break;
        }


        case "partner":
        // Tipologia di utenti: 11.
        if(in_array ( 11, JUserHelper::getUserGroups($data['id'])))
        {
          JLog::add('L\'utente esiste già, e i gruppi sono ok.');
          break;
        } else {
          JLog::add('L\'utente esiste, ma devo cambiare i gruppi.');
          JUserHelper::setUserGroups($data['id'], array(11, 2));
          break;
        }


        case "director":
        // Tipologia di utenti: 14.
        if(in_array ( 14, JUserHelper::getUserGroups($data['id'])))
        {
          JLog::add('L\'utente esiste già, e i gruppi sono ok.');
          break;
        } else {
          JLog::add('L\'utente esiste, ma devo cambiare i gruppi.');
          JUserHelper::setUserGroups($data['id'], array(14, 2));
          break;
        }
      }
    } else JLog::add('L\'utente esiste già, non ne modifico il gruppo.');

    return true;
  }
}
