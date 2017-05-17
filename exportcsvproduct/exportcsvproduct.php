<?php
if (!defined('_PS_VERSION_'))
{
  exit;
}

class exportcsvproduct extends Module {

    
    public function __construct() {
        $this->name = 'exportcsvproduct';
        $this->tab = 'export';
        $this->version = '1.0.0';
        $this->author = 'Roberto Morais';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Export Product');
        $this->description = $this->l('');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('MYMODULE_NAME'))
          $this->warning = $this->l('No name provided');
    }
    
    //Install module
   public function install() {
        // Install Tabs
        $parent_tab = new Tab();
        // Need a foreach for the language
        $parent_tab->name[$this->context->language->id] = $this->l('Export Product');
        $parent_tab->class_name = 'AdminExportProduct';
        $parent_tab->id_parent = 9; // Catalogo tab
        $parent_tab->module = $this->name;
        $parent_tab->add();
        
        if (!parent::install())
                  return false;
        return true;
   }
//Uninstall module
   public function uninstall() {
        // Uninstall Tabs
        $id_tab = (int)Tab::getIdFromClassName('AdminExportProduct');
        if ($id_tab) {
            $tab = new Tab($id_tab);
            $tab->delete();
        }
        
        if (!parent::uninstall())
                  return false;
        return true;
   }
}