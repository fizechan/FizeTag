<?php


namespace fize\html;


/**
 * HTML标签生成类
 */
class Html
{

    /**
     * 创建标签
     * @param string $tag 标签名
     * @param array $attrs 属性
     * @param bool $close 是否闭合
     * @param string $text 显示字符串
     * @return string 返回HTML代码段
     */
    public static function createTag($tag, array $attrs = [], $close = false, $text = '')
    {
        $attr = self::attributes($attrs);
        if ($close) {
            return "<{$tag}{$attr} />";
        } else {
            return "<{$tag}{$attr}>$text</{$tag}>";
        }
    }

    /**
     * 数组转换成一个HTML属性字符串。
     * @param array $attrs 属性
     * @return string
     */
    protected static function attributes(array $attrs)
    {
        $attributes = [];
        foreach ($attrs as $key => $value) {
            $element = self::attributeElement($key, $value);
            if (!is_null($element)) {
                $attributes[] = $element;
            }

        }
        return count($attributes) > 0 ? ' ' . implode(' ', $attributes) : '';
    }

    /**
     * 拼接成一个属性。
     * @param string $key 属性名
     * @param string $value 属性值
     * @return string
     */
    protected static function attributeElement($key, $value)
    {
        if (is_null($value)) {
            return '';
        }

        if (is_numeric($key)) {
            $key = $value;
        }

        $bool1_attrs = [
            'async', 'autofocus', 'autoplay',
            'challenge', 'checked', 'compact', 'controls',
            'declare', 'default', 'defer', 'disabled',
            'loop',
            'muted', 'multiple',
            'nohref', 'novalidate',
            'preload',
            'open',
            'readonly', 'required', 'reversed',
            'selected'
        ];
        $bool2_attrs = ['autocomplete'];
        if(in_array($key, $bool1_attrs)) {  //布尔类型的兼容性处理
            if($value === true) {
                $value = $key;
            } elseif ($value === false) {
                return '';
            }
        }elseif (in_array($key, $bool2_attrs)) {  //开关类型的兼容性处理
            if($value === true) {
                $value = 'on';
            } elseif ($value === false) {
                $value = 'off';
            }
        }elseif($key == 'title') {  //转HTML实体
            $value = htmlentities($value);

            //$value = addslashes($value);
        }

        return $key . '="' . $value . '"';
    }

}
