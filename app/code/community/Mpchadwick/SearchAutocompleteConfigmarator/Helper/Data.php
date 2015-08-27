<?php

class Mpchadwick_SearchAutocompleteConfigmarator_Helper_Data extends Mage_CatalogSearch_Helper_Data
{
    /**
     * Override parent so we can specify our own model
     *
     * @return Mpchadwick_SearchAutocompleteConfigmarator_Model_Query
     */
    public function getQuery()
    {
        if (!$this->_query) {
            $this->_query = Mage::getModel('mpchadwick_searchautocompleteconfigmarator/query')
                ->loadByQuery($this->getQueryText());
            if (!$this->_query->getId()) {
                $this->_query->setQueryText($this->getQueryText());
            }
        }
        return $this->_query;
    }
}
