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
  public function onUserBeforeSave($oldUser, $isNew, $newUser)
  {
    JLog::add('Avvio la classificazione dell\'utente.');
    JLog::add($newUser);
    JLog::add($newUser['com_fields']);
    JLog::add("...");
    JLog::add($oldUser);
    JLog::add($oldUser['com_fields']);

    // if ($isNew)
    if(true)
    {
      JLog::add('Il tipo è ' . $newUser['tipologia'] . '.');

      switch ($newUser['com_fields']['tipologia'])
      {
        case "base":
        // Tipologia di utenti: 15.
        JUserHelper::addUserToGroup($newUser['id'], 15);
        break;
        case "medic":
        // Tipologia di utenti: 10.
        JUserHelper::addUserToGroup($newUser['id'], 10);
        break;
        case "partner":
        // Tipologia di utenti: 11.
        JUserHelper::addUserToGroup($newUser['id'], 11);
        break;
        case "director":
        // Tipologia di utenti: 14.
        JUserHelper::addUserToGroup($newUser['id'], 14);
        break;
      }
    } else JLog::add('L\'utente esiste già, non ne modifico il gruppo.');

    return true;
  }
}
