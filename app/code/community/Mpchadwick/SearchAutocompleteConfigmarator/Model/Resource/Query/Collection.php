<?php

class Mpchadwick_SearchAutocompleteConfigmarator_Model_Resource_Query_Collection
    extends Mage_CatalogSearch_Model_Resource_Query_Collection
{
    /**
     * Override of parent
     *
     * - Like match position
     *
     * @param string $query
     * @return Mage_CatalogSearch_Model_Resource_Query_Collection
     */
    public function setQueryFilter($query)
    {
        $ifSynonymFor = $this->getConnection()
            ->getIfNullSql('synonym_for', 'query_text');
        $this->getSelect()->reset(Zend_Db_Select::FROM)->distinct(true)
            ->from(
                array('main_table' => $this->getTable('catalogsearch/search_query')),
                array('query'      => $ifSynonymFor, 'num_results')
            )
            ->where('num_results > 0 AND display_in_terms = 1 AND query_text LIKE ?',
                Mage::getResourceHelper('core')->addLikeEscape($query, array(
                    'position' => Mage::getStoreConfig('catalog/search/like_match_position')
                )))
            ->order('popularity ' . Varien_Db_Select::SQL_DESC);
        if ($this->getStoreId()) {
            $this->getSelect()
                ->where('store_id = ?', (int)$this->getStoreId());
        }
        return $this;
    }
}
