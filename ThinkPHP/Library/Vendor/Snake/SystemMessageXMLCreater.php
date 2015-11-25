<?php
/**
 *
 * User: snake
 * Date: 14-12-2
 * Time: 下午7:30
 */




class SystemMessageXMLCreater
{
    /**
     * 参数
     *
     * @var array
     */
    public $params;

    function __construct($params)
    {
        //p($params);die;
        # 产生一个这样子的数组
        # 就可以生成相应的xml
       /* $params = array(
            # CDATA的数据
            'CDATA' => 'aabbccdd',
            # 根节点
            'root' => array(
                # 节点名称
                'name' => 'control',
                # 节点属性
                'attrs' => array(
                    array(
                        'name' => 'value',
                        'value' => 'display'
                    ),
                    array(
                        'name' => 'id',
                        'value' => '30209'
                    )
                ),
                # 子节点
                'nodes' => array(
                    array(
                        'name' => 'zone',
                        'attrs' => array(
                            array(
                                'name' => 'system',
                                'value' => '1'
                            ),
                            array(
                                'name' => 'hall',
                                'value' => '1'
                            ),
                            array(
                                'name' => 'room',
                                'value' => '1'
                            ),
                            array(
                                'name' => 'game',
                                'value' => '1'
                            ),
                            array(
                                'name' => 'tip',
                                'value' => '1'
                            ),
                            array(
                                'name' => 'tray',
                                'value' => '1'
                            ),
                            array(
                                'name' => 'model',
                                'value' => '1'
                            ),
                            array(
                                'name' => 'modeless',
                                'value' => '0'
                            ),
                        ),
                        'nodes' => array(
                            array(
                                'name' => 'font',
                                'attrs' => array(
                                    array(
                                        'name' => 'name',
                                        'value' => 'Verdana'
                                    ),
                                    array(
                                        'name' => 'size',
                                        'value' => '12'
                                    ),
                                    array(
                                        'name' => 'r',
                                        'value' => '205'
                                    ),
                                    array(
                                        'name' => 'g',
                                        'value' => '0'
                                    ),
                                    array(
                                        'name' => 'b',
                                        'value' => '0'
                                    )
                                ),
                                'nodes' => array(
                                    array(
                                        'name' => 'data',
                                        'attrs' => array(
                                            array(
                                                'name' => 'value',
                                                #'value' => 'i\'m data'
                                                'value' => '服务器维护,请下线!'
                                            )
                                        )
                                    ),

                                )
                            ),
                            array(
                                'name' => 'parameter',
                                'attrs' => array(
                                    array(
                                        'name' => 'href',
                                        'value' => 'www.baidu.com'
                                    ),
                                    array(
                                        'name' => 'displaytime',
                                        'value' => '10'
                                    ),
                                    array(
                                        'name' => 'buttontype',
                                        'value' => '0'
                                    ),
                                    array(
                                        'name' => 'delaymax',
                                        'value' => '10'
                                    )
                                ),
                                'nodes' => array()
                            ),
                            array(
                                'name' => 'loop',
                                'attrs' => array(
                                    array(
                                        'name' => 'interval',
                                        'value' => '2'
                                    ),
                                    array(
                                        'name' => 'endtime',
                                        'value' => '12/03/2014 22:14:00'
                                    ),
                                    array(
                                        'name' => 'count',
                                        'value' => '3'
                                    )
                                )
                            )
                        )
                    )
                )
            )
        );*/
        $this->params = $params;
    }

    public function creater($type = '1')
    {
        switch ($type) {
            case '1':
                return $this->type1();
                break;
        }
    }

    public function type1()
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;

        //$cdata = $dom->createCDATASection($this->params['CDATA']);
        $dom->appendChild($cdata);

        $root = $dom->createElement($this->params['root']['name']);
        # 根节点属性
        foreach ($this->params['root']['attrs'] as $attr) {
            $attrobj = $dom->createAttribute($attr['name']);
            $attrobj->value = $attr['value'];
            $root->appendChild($attrobj);
        }

        # 根节点的子节点
        foreach ($this->params['root']['nodes'] as $node) {
            # 二级节点
            $nodeobj = $dom->createElement($node['name']);
            # 二级节点属性
            foreach ($node['attrs'] as $attr2) {
                $attrobj = $dom->createAttribute($attr2['name']);
                $attrobj->value = $attr2['value'];
                $nodeobj->appendChild($attrobj);
            }

            # 二级节点的子节点
            foreach ($node['nodes'] as $node2) {
                # 三级节点
                $nodeobj2 = $dom->createElement($node2['name']);
                # 三级节点属性
                foreach ($node2['attrs'] as $attr3) {
                    $attrobj3 = $dom->createAttribute($attr3['name']);
                    $attrobj3->value = $attr3['value'];
                    $nodeobj2->appendChild($attrobj3);
                }

                # 三级节点的子节点
                foreach ($node2['nodes'] as $node3) {
                    # 四级节点
                    $nodeobj3 = $dom->createElement($node3['name']);
                    # 四级节点属性
                    foreach ($node3['attrs'] as $attr4) {
                        $attrobj4 = $dom->createAttribute($attr4['name']);
                        $attrobj4->value = $attr4['value'];
                        $nodeobj3->appendChild($attrobj4);
                    }

                    # 四级节点的子节点
                    foreach ($node3['nodes'] as $node4) {
                        # 五级节点
                        $nodeobj4 = $dom->createElement($node4['name']);
                        # 五级节点属性
                        foreach ($node4['attrs'] as $attr5) {
                            $attrobj5 = $dom->createAttribute($attr5['name']);
                            $attrobj5->value = $attr5['value'];
                            $nodeobj4->appendChild($attrobj5);
                        }

                        $nodeobj3->appendChild($nodeobj4);
                    }

                    $nodeobj2->appendChild($nodeobj3);
                }
                $nodeobj->appendChild($nodeobj2);
            }
            $root->appendChild($nodeobj);
        }
        $dom->appendChild($root);

        return $dom->saveXML();
    }
} 