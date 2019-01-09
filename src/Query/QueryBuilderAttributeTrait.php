<?php

/**
 * @copyright  Copyright (c) Flipbox Digital Limited
 * @license    https://github.com/flipbox/salesforce/blob/master/LICENSE.md
 * @link       https://github.com/flipbox/salesforce
 */

namespace Flipbox\Salesforce\Query;

/**
 * @author Flipbox Factory <hello@flipboxfactory.com>
 * @since 3.0.0
 */
trait QueryBuilderAttributeTrait
{
    /**
     * @var QueryBuilderInterface|string
     */
    private $query = '';

    /**
     * @param array $config
     * @return QueryBuilderInterface
     */
    public function getQuery(array $config = []): QueryBuilderInterface
    {
        if (!$this->query instanceof QueryBuilderInterface) {
            $this->query = $this->createQueryBuilder($this->query);
        }

        if (!empty($config)) {
            $this->populateQuery(
                $this->query,
                $config
            );
        };

        return $this->query;
    }

    /**
     * @param $query
     */
    public function setQuery($query)
    {
        if ($query instanceof QueryBuilderInterface) {
            $this->query = $query;
            return;
        }

        $this->getQuery($this->normalizeQueryConfig($query));
    }

    /**
     * @param QueryBuilderInterface $query
     * @param array $config
     */
    private function populateQuery(QueryBuilderInterface $query, array $config = [])
    {
        foreach ($config as $name => $value) {
            $setter = 'set' . $name;
            if (method_exists($this, $setter)) {
                $this->$setter($value);
                continue;
            }

            if (property_exists($query, $name)) {
                $query->{$name} = $value;
                continue;
            }
        }
    }

    /**
     * @param $config
     * @return array
     */
    private function normalizeQueryConfig($config): array
    {
        if (!is_array($config)) {
            if (is_string($config)) {
                $config = ['soql' => $config];
            } else {
                $config = [$config];
            }
        }

        return array_filter($config);
    }

    /**
     * @param $query
     * @return QueryBuilderInterface
     */
    protected function createQueryBuilder($query): QueryBuilderInterface
    {
        if ($query instanceof QueryBuilderInterface) {
            return $query;
        }

        $builder = new DynamicQueryBuilder();

        $this->populateQuery(
            $builder,
            $this->normalizeQueryConfig($query)
        );

        return $builder;
    }
}
