<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */
namespace Swoft\Db\Entity;

use Swoft\Stdlib\Helper\StringHelper;
use Swoft\Connection\Pool\Contract\ConnectionInterface;
use Swoft\Db\Connection\Connection;

abstract class AbstractGenerator
{
    /**
     * @var array $uses 模板use
     */
    protected $uses = [
        'Swoft\Db\Eloquent\Model',
        'Swoft\Db\Annotation\Mapping\Column',
        'Swoft\Db\Annotation\Mapping\Entity',
        'Swoft\Db\Annotation\Mapping\Id',
        'Swoft\Db\Entity\Types'
    ];

    /**
     * 实体基类
     */
    protected $extends = 'Model';

    /**
     * @var string $entity 实体命名
     */
    protected $entity = null;

    /**
     * @var string $entityName 实体中文名
     */
    protected $entityName = null;

    /**
     * @var string $entityClass 实体类名
     */
    protected $entityClass = null;

    /**
     * @var string $entityDate 实体类创建时间
     */
    protected $entityDate = null;

    /**
     * @var string $fields 字段
     */
    protected $fields = null;

    /**
     * @var string 字段setter
     */
    protected $setter = null;

    /**
     * @var string 字段getter
     */
    protected $getter = null;

    /**
     * @var Connection $dbHandler 数据库连接句柄
     */
    protected $dbHandler = null;

    public function __construct(Connection $dbConnect)
    {
        $this->dbHandler = $dbConnect;
    }

    /**
     * 解析属性
     *
     * @param string $entity     实体
     * @param mixed  $entityName 实体注释名称
     * @param array  $fields     字段
     * @param Schema $schema     schema对象
     * @param string $instance   数据库实例别名
     */
    protected function parseProperty(string $entity, $entityName, array $fields, Schema $schema, $instance)
    {
        $this->entity     = $entity;
        $this->entityName = $entityName;
        $this->entityDate = date('Y年m月d日 H:i:s');
        $this->fields     = $fields;
	    $this->entityClass=$this->getEntityClass($this->entity,$this->removeTablePrefix);

        $param = [
            $schema,
            $this->uses,
            $this->extends,
            $this->entity,
            $this->entityName,
            $this->entityClass,
            $this->entityDate,
            $this->fields,
            $instance,
        ];

        $sgGenerator = new SetGetGenerator();
        $sgGenerator(...$param);
    }

	/**
	 * @param $removeTablePrefix
	 * @return string
	 */
	protected function getEntityClass($entityClass,$removeTablePrefix): string
	{
		if (!empty($removeTablePrefix)) {
			$entityClass = StringHelper::replaceFirst($removeTablePrefix, '', $entityClass);
		}
		$entityClass = StringHelper::camel($entityClass);
		return ucfirst($entityClass);
	}
}
