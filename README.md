# swoft 2.0 entity creater

## install

```bash
    composer require jlzan1314/swoft-entity
```

## doc
Auto create entity by table structure

entity:create -d[|--database] <database> --instance <instance>
entity:create -d[|--database] <database> [table] -instnace <instnace>
entity:create -d[|--database] <database> --i[|--include] <table> --instnace <instnace>
entity:create -d[|--database] <database> --i[|--include] <table> -instnace <instnace>
entity:create -d[|--database] <database> --i[|--include] <table1,table2> --instnace <instnace>
entity:create -d[|--database] <database> --i[|--include] <table1,table2> -e[|--exclude] <table3> --instance <instance>
entity:create -d[|--database] <database> --i[|--include] <table1,table2> -e[|--exclude] <table3,table4> --instance <instance>

-d 数据库
--database 数据库
-i 指定特定的数据表，多表之间用逗号分隔
--include 指定特定的数据表，多表之间用逗号分隔
-e 排除指定的数据表，多表之间用逗号分隔
--exclude 排除指定的数据表，多表之间用逗号分隔
--remove-table-prefix 去除前缀
--entity-file-path 实体路径(必须在以@app开头并且在app目录下存在的目录,否则将会重定向到@app/Model/Entity)
--instance 设置数据库实例，默认default
--extends 设置模型的实体基类
-f 强制覆盖实体文件  

## use
./bin/swoft entity:create -d [database] -f