<?php

class Mpchadwick_SearchAutocompleteConfigmarator_Block_Autocomplete extends Mage_CatalogSearch_Block_Autocomplete
{
    /** @var boolean Determine whether we should hide the result count */
    protected $_hideResultCount;

    /**
     * Override parent
     *
     * - Hide result count, if necessary
     *
     * @return string
     */
    protected function _toHtml()
    {
        $html = '';

        if (!$this->_beforeToHtml()) {
            return $html;
        }

        $suggestData = $this->getSuggestData();
        if (!($count = count($suggestData))) {
            return $html;
        }

        $count--;

        $html = '<ul><li style="display:none"></li>';
        foreach ($suggestData as $index => $item) {
            if ($index == 0) {
                $item['row_class'] .= ' first';
            }

            if ($index == $count) {
                $item['row_class'] .= ' last';
            }

            $html .=  '<li title="'.$this->escapeHtml($item['title']).'" class="'.$item['row_class'].'">'
                . $this->_getResultCountHtml($item['num_of_results']) . $this->escapeHtml($item['title']).'</li>';
        }

        $html.= '</ul>';

        return $html;
    }

    /**
     * Override parent
     *
     * - Use our helper
     * - Apply any configured limit
     *
     * @return array the autocomplete suggestions
     */
    public function getSuggestData()
    {
        if (!$this->_suggestData) {
            $collection = Mage::helper('mpchadwick_searchautocompleteconfigmarator')->getQuery()->getSuggestCollection();
            $query = $this->helper('catalogsearch')->getQueryText();
            $counter = 0;
            $data = array();
            foreach ($collection as $item) {
                $_data = array(
                    'title' => $item->getQueryText(),
                    'row_class' => (++$counter)%2?'odd':'even',
                    'num_of_results' => $item->getNumResults()
                );

                if ($item->getQueryText() == $query) {
                    array_unshift($data, $_data);
                }
                else {
                    $data[] = $_data;
                }
                if ($limit = (int) Mage::getStoreConfig('catalog/search/autocomplete_limit')) {
                    $data = array_splice($data, 0, $limit);
                }
            }
            $this->_suggestData = $data;
        }
        return $data;
    }

    /**
     * Get the HTML for the result count
     *
     * @param string $val the number of results
     * @return string the HTML to use
     */
    protected function _getResultCountHtml($val)
    {
        if ($this->_getHideResultCount()) {
            return '';
        }
        return '<span class="amount">' . $val . '</span>';
    }

    /**
     * Determine whether or not to hide the result count
     *
     * @return boolean
     */
    protected function _getHideResultCount()
    {
        if (is_null($this->_hideResultCount)) {
            $this->_hideResultCount = Mage::getStoreConfigFlag('catalog/search/hide_result_count');
        }
        return $this->_hideResultCount;
    }

}
