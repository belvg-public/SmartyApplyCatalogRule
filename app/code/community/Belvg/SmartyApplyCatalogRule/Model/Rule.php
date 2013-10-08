<?php 

class Belvg_SmartyApplyCatalogRule_Model_Rule extends Mage_CatalogRule_Model_Rule  {

	public function applyRule($rule_id)
    {
    	$rule = Mage::getModel('catalogrule/rule')->load($rule_id);
        $this->_getResource()->updateRuleProductData($rule);
        $this->_getResource()->applyAllRulesForDateRange();
        $this->_invalidateCache();
        $indexProcess = Mage::getSingleton('index/indexer')->getProcessByCode('catalog_product_price');
        if ($indexProcess) {
            $indexProcess->reindexAll();
        }
    }

}