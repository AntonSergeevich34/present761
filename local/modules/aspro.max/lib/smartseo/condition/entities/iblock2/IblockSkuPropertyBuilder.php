<?php

namespace Aspro\Max\Smartseo\Condition\Entities\Iblock2;

use Aspro\Max\Smartseo,
	\Aspro\Max\Smartseo\Models\SmartseoSkuIblockElementPropSingleTable,
	\Aspro\Max\Smartseo\Models\SmartseoSkuIblockElementPropMultipleTable;

class IblockSkuPropertyBuilder extends IblockPropertyBuilder
{
	protected $name = 'isp';
	protected $tableAlias = 'sku';
	protected $skuIblockId = null;
	protected $skuPropertyId = null;

	public function __construct($iblockId, $skuIblockId, $skuPropertyId)
	{
		$this->skuIblockId = $skuIblockId;
		$this->skuPropertyId = $skuPropertyId;

		parent::__construct($iblockId);
	}

	public function getModelClass()
	{
		return $this->modelClass;
	}

	public function getSkuPropertyId()
	{
		return $this->skuPropertyId;
	}

	public function getSkuIblockId()
	{
		return $this->skuIblockId;
	}

	protected function getSectionReferenceField()
	{
		return 'this.PROPERTY_' . $this->getSkuPropertyId();
	}

	protected function getElementReferenceField()
	{
		return 'this.PROPERTY_' . $this->getSkuPropertyId();
	}

	protected function initModels()
	{
		$this->modelClass = SmartseoSkuIblockElementPropSingleTable::class;

		$this->modelMultipleClass = SmartseoSkuIblockElementPropMultipleTable::class;

		SmartseoSkuIblockElementPropSingleTable::setIblockId($this->getSkuIblockId());

		SmartseoSkuIblockElementPropMultipleTable::setIblockId($this->getSkuIblockId());

		if (!SmartseoSkuIblockElementPropSingleTable::isTableExists()) {
			throw new \Exception('Table name ' . SmartseoSkuIblockElementPropSingleTable::getTableName() . ' no exists');
		}
	}
}
