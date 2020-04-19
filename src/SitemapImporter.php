<?php

/**
 * Sitemap XML importer
 */

 namespace Bartwind\SitemapImporter;

 use Mtownsend\XmlToArray\XmlToArray as XmlToArray;

 class SitemapImporter
 {

    /**
     * @var null|string
     */
    private $xmlRaw = null;

    /**
     * @var array
     */
    private $xmlArray = [];

    /**
     * @var array
     */
    private $sitemapArray = [];

    /**
     * SitemapImporter constructor
     *
     * @param string $source
     * @return void
     */
    public function __construct(string $source)
    {
        $this->importSitemapXml($source);
        $this->prepareFormattedSitemapArray();
    }

    /**
     * Get XML raw string data content
     *
     * @return string
     */
    public function getXmlRaw() : string
    {
        return $this->xmlRaw;
    }

    /**
     * Set XML raw data content
     *
     * @param string $data
     * @return void
     */
    public function setXmlRaw(string $data) : void
    {
        $this->xmlRaw = $data;
    }

    /**
     * Get XML array
     *
     * @return array|null
     */
    public function getXmlArray()
    {
        return $this->xmlArray;
    }

    /**
     * Set XML array
     *
     * @param array $xmlArray
     * @return void
     */
    public function setXmlArray(array $xmlArray) : void
    {
        $this->xmlArray = $xmlArray;
    }

    /**
     * Get sitemap array formatted
     *
     * @return array
     */
    public function getSitemapArray() : array
    {
        return $this->sitemapArray;
    }

    /**
     * Set sitemap array formatted
     *
     * @param array $array
     * @return void
     */
    public function setSitemapArray(array $array) : void
    {
        $this->sitemapArray = $array;
    }

    /**
     * Import sitemap XML from source
     *
     * @param string $source
     * @return boolean
     */
    public function importSitemapXml(string $source) : bool
    {
        $data = $this->getSourceContent($source);
        if (!empty($data)) {
            $this->setXmlRaw($data);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Prepare sitemap formatted array
     *
     * @return void
     */
    protected function prepareFormattedSitemapArray()
    {
        $xmlRaw = $this->getXmlRaw();
        $xmlArray = XmlToArray::convert($xmlRaw);

        if (!is_array($xmlArray)) {
            return false;
        }

        $this->setXmlArray($xmlArray);

        $sitemapArrayFormatted = [];

        $this->setSitemapArray($sitemapArrayFormatted);
    }

    /**
     * Get source content from source location path/url
     *
     * @param string $source
     * @return string|bool
     */
    protected function getSourceContent(string $source)
    {
        return file_get_contents($source);
    }

 }