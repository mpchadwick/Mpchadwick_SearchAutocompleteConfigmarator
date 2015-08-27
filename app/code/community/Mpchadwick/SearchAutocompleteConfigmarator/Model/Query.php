<?php

class Mpchadwick_SearchAutocompleteConfigmarator_Model_Query extends Mage_CatalogSearch_Model_Query
{
    /**
     * Override parent so we can specify our resource model
     *
     * @return Mpchadwick_SearchAutocompleteConfigmarator_Model_Resource_Query_Collection
     */
    public function getSuggestCollection()
    {
        $collection = $this->getData('suggest_collection');
        if (is_null($collection)) {
            $collection = Mage::getResourceModel('mpchadwick_searchautocompleteconfigmarator/query_collection')
                ->setStoreId($this->getStoreId())
                ->setQueryFilter($this->getQueryText());
            $this->setData('suggest_collection', $collection);
        }
        return $collection;
    }
}
