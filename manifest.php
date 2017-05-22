<?php

    $manifest =array(
        'acceptable_sugar_flavors' => array('CE','PRO','CORP','ENT','ULT'),
        'acceptable_sugar_versions' => array(
            'exact_matches' => array(),
            'regex_matches' => array('(.*?)\\.(.*?)\\.(.*?)$'),
        ),
        'author' => 'KSK Digital',
        'description' => 'Installs magento integration logic hook',
        'icon' => '',
        'is_uninstallable' => true,
        'name' => 'Magento integration',
        'published_date' => '2017-05-014 2017 20:45:04',
        'type' => 'module',
        'version' => '003',
    );
    
    $installdefs =array(
        'id' => 'package_001',
        'copy' => array(
            0 => array(
                'from' => '<basepath>/Files/custom/modules/Contacts/magentoPush.php',
                'to' => 'custom/modules/magentoPush.php',
               // 'to' => 'custom/modules/Contacts/contacts_save.php',
            ),
        ),
        'logic_hooks' => array(
            array(
                'module' => 'Contacts',
                'hook' => 'after_save',
                'order' => 78,
                'description' => 'Update address',
                'file' => 'custom/modules/magentoPush.php',
                'class' => 'magentoPush',
                'function' => 'UpdateMagentoContact',
            ),
            array(
                'module' => 'AOS_Products_Quotes',
                'hook' => 'after_save',
                'order' => 1,
                'description' => 'line item update',
                'file' => 'custom/modules/magentoPush.php',
                'class' => 'magentoPush',
                'function' => 'lineItemUpdate',
            ),
            array(
                'module' => 'Cases',
                'hook' => 'after_save',
                'order' => 2,
                'description' => 'Case creation',
                'file' => 'custom/modules/magentoPush.php',
                'class' => 'magentoPush',
                'function' => 'caseCreation',
            ),
            array(
                'module' => 'ksk05_Header3',
                'hook' => 'after_save',
                'order' => 1,
                'description' => 'order update',
                'file' => 'custom/modules/magentoPush.php',
                'class' => 'magentoPush',
                'function' => 'orderUpdate',
            ),
        ),
    );




    /*
      'logic_hooks' => array(
            array(
                'module' => 'AOS_Products_Quotes',
                'hook' => 'before_save',
                'order' => 1,
                'description' => 'line item update',
                'file' => 'custom/modules/contacts_save.php',
                'class' => 'magentoPush',
                'function' => 'lineItemUpdate',
            ),
        ),
        'logic_hooks' => array(
            array(
                'module' => 'cases',
                'hook' => 'before_save',
                'order' => 2,
                'description' => 'Case creation',
                'file' => 'custom/modules/contacts_save.php',
                'class' => 'magentoPush',
                'function' => 'caseCreation',
            ),
        ),
        'logic_hooks' => array(
            array(
                'module' => 'ksk05_Header3',
                'hook' => 'before_save',
                'order' => 1,
                'description' => 'order update',
                'file' => 'custom/modules/contacts_save.php',
                'class' => 'magentoPush',
                'function' => 'orderUpdate',
            ),
        ),
      */

?>