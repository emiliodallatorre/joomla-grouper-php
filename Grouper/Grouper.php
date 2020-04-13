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
  public function onUserAfterSave($data, $isNew, $result, $error)
  {
    JLog::add('Avvio la classificazione dell\'utente.');

    // if ($isNew)
    if (true)
    {
      JLog::add('Il tipo è ' . $data['com_fields']['tipologia'] . '.');

      switch ($data['com_fields']['tipologia'])
      {
        case "base":
        // Tipologia di utenti: 15.
        JUserHelper::addUserToGroup($data['id'], 15);
        break;
        case "medic":
        // Tipologia di utenti: 10.
        JUserHelper::addUserToGroup($data['id'], 10);
        break;
        case "partner":
        // Tipologia di utenti: 11.
        JUserHelper::addUserToGroup($data['id'], 11);
        break;
        case "director":
        // Tipologia di utenti: 14.
        JUserHelper::addUserToGroup($data['id'], 14);
        break;
      }
    } else JLog::add('L\'utente esiste già, non ne modifico il gruppo.');

    return true;
  }
}
