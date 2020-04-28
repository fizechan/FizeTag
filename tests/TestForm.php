<?php


namespace app\controller;

use fize\tag\Form;

/**
 * @todo 待修改
 * @package app\controller
 */
class TestForm
{

    public function ActionInput()
    {
        $html1 = Form::input('text', 'field1');
        echo $html1 . "\r\n";

        $html2 = Form::input('button', '按钮1');
        echo $html2 . "\r\n";

        $html3 = Form::input('checkbox', '多选框1', ['name' => 'field2', 'checked' => true]);
        echo $html3 . "\r\n";

        $html4 = Form::input('text', '输入框4', ['autocomplete' => true, 'required' => true, 'size' => 14]);
        echo $html4 . "\r\n";
    }

    public function ActionLabel()
    {
        $html1 = Form::label('测试1');
        echo $html1 . "\r\n";

        $html2 = Form::label('测试2', ['for' => 'input2']);
        echo $html2 . "\r\n";

        $html3 = Form::label('测试3', [ 'for' => 'input3', 'id' => 'label1', 'title' => '"就是要有故意的双引号"' ]);
        echo $html3 . "\r\n";

        $html4 = Form::label('测试4', ['for' =>  'input4', 'form' => 'form2', 'id' => 'label1', 'title' => '"就是要有故意的双引号"和单引号\'' ]);
        echo $html4 . "\r\n";
    }

    public function ActionTextarea()
    {
        $html1 = Form::textarea('"就是要有故意的双引号"和单引号\'');
        echo $html1;
    }

    public function ActionButton()
    {
        $html1 = Form::button('"就是要有故意的双引号"和单引号\'');
        echo $html1;
    }

    public function ActionSelect()
    {
        //简易
        $html1 = Form::select('test1', 'val2', ['val1' => '选项1', 'val2' => '选项2', 'val3' => '选项3']);
        echo $html1 . "\r\n";

        //多选
        $html2 = Form::select('test2', ['val2', 'val3'], ['val1' => '选项1', 'val2' => '选项2', 'val3' => '选项3'], ['class' => 'abc']);
        echo $html2 . "\r\n";

        //复杂
        $html3 = Form::select(
            'test3',
            'val22',
            [
                [
                    'label' => 'val1x',
                    'options' => [
                        [
                            'text' => '选项11',
                            'value' => 'val11',
                            'attrs' => [
                                'disabled' => true,
                                'class' => 'abc1 bde1'
                            ]
                        ],
                        [
                            'text' => '选项12',
                            'value' => 'val12',
                            'attrs' => [
                                'disabled' => false,
                                'class' => 'abc2 bde2'
                            ]
                        ]
                    ],
                ],
                [
                    'label' => 'val2x',
                    'options' => [
                        [
                            'text' => '选项21',
                            'value' => 'val21'
                        ],
                        [
                            'text' => '选项22',
                            'value' => 'val22'
                        ],
                        [
                            'text' => '选项23',
                            'value' => 'val23'
                        ]
                    ],
                ],
                [
                    'label' => 'val3x',
                    'options' => [
                        [
                            'text' => '选项31',
                            'value' => 'val31'
                        ],
                        [
                            'text' => '选项32',
                            'value' => 'val32'
                        ],
                        [
                            'text' => '选项33',
                            'value' => 'val33'
                        ]
                    ],
                ],
            ],
            [
                'id' => 'select1'
            ],
            true
        );
        echo $html3 . "\r\n";
    }

    public static function ActionKeygen()
    {
        $html1 = Form::keygen('kkk1');
        echo $html1;
    }

    public static function ActionOutput()
    {
        $html1 = Form::output('kkk1', null, '12345678', ['value' => '123456']);
        echo $html1;
    }
}
