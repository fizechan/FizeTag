<?php

namespace Fize\Tag;

/**
 * 表单
 */
class Form
{

    /**
     * 创建input标签
     * @param string $type  类型
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function input($type, $name = null, $value = '', array $attrs = [])
    {
        $def_attrs = ['type' => $type, 'name' => $name, 'value' => $value];
        $attrs = array_merge($def_attrs, $attrs);
        return Html::createTag('input', $attrs, true);
    }

    /**
     * 创建textarea标签
     * @param string $name  名称
     * @param string $text  文本内容
     * @param array  $attrs 属性
     * @return string
     */
    public static function textarea($name = null, $text = '', array $attrs = [])
    {
        $def_attrs = ['name' => $name];
        $attrs = array_merge($def_attrs, $attrs);
        return Html::createTag('textarea', $attrs, false, $text);
    }

    /**
     * 创建button标签
     * @param string $text  文本
     * @param string $name  名称
     * @param string $value 值
     * @param string $type  类型
     * @param array  $attrs 属性
     * @return string
     */
    public static function button($text = '', $name = null, $value = null, $type = 'button', array $attrs = [])
    {
        $def_attrs = ['type' => $type, 'name' => $name, 'value' => $value];
        $attrs = array_merge($def_attrs, $attrs);
        return Html::createTag('button', $attrs, false, $text);
    }

    /**
     * 创建select标签
     * @param string $name      名称
     * @param string $selecteds 选中值，多选以数组形式表示
     * @param array  $options   选项
     * @param array  $attrs     属性
     * @param bool   $is_group  参数$options是否为optgroup标签
     * @return string
     */
    public static function select($name = null, $selecteds = null, array $options = [], array $attrs = [], $is_group = false)
    {
        if (is_array($selecteds)) {
            $attrs['multiple'] = true;
        }
        if (is_string($selecteds)) {
            $selecteds = [$selecteds];
        }
        $inner_text = '';
        if ($is_group) {
            foreach ($options as $optgroup) {
                $ogp_label = $optgroup['label'];
                $ogp_options = $optgroup['options'];
                $ogp_attrs = $optgroup['attrs'] ?? [];
                $inner_text .= self::optgroup($ogp_label, $ogp_options, $ogp_attrs, $selecteds);
            }
        } else {
            foreach ($options as $key => $option) {
                if (is_string($key)) {
                    $text = $option;
                    $value = $key;
                    $option_selected = false;
                    if (in_array($value, $selecteds)) {
                        $option_selected = true;
                    }
                    $inner_text .= self::option($text, $value, $option_selected);
                } else {
                    $text = $option['text'] ?? '';
                    $value = $option['value'] ?? '';
                    $option_selected = $option['selected'] ?? false;
                    if (in_array($value, $selecteds)) {
                        $option_selected = true;
                    }
                    $attrs = $option['attrs'] ?? [];
                    $inner_text .= self::option($text, $value, $option_selected, $attrs);
                }
            }
        }

        $def_attrs = ['name' => $name];
        $attrs = array_merge($def_attrs, $attrs);
        return Html::createTag('select', $attrs, false, $inner_text);
    }

    /**
     * 创建optgroup标签
     * @param string $label     描述
     * @param array  $options   option选项
     * @param array  $attrs     属性
     * @param mixed  $selecteds 选中项，多选以数组形式表示
     * @return string
     */
    public static function optgroup($label, array $options, array $attrs = [], $selecteds = null)
    {
        if (is_string($selecteds)) {
            $selecteds = [$selecteds];
        }
        $inner_text = '';
        foreach ($options as $key => $option) {
            if (is_string($key)) {
                $text = $option;
                $value = $key;
                $option_selected = false;
                if (in_array($value, $selecteds)) {
                    $option_selected = true;
                }
                $inner_text .= self::option($text, $value, $option_selected);
            } else {
                $text = $option['text'] ?? '';
                $value = $option['value'] ?? '';
                $option_selected = $option['selected'] ?? false;
                if (in_array($value, $selecteds)) {
                    $option_selected = true;
                }
                $attrs = $option['attrs'] ?? [];
                $inner_text .= self::option($text, $value, $option_selected, $attrs);
            }
        }
        $def_attrs = ['label' => $label];
        $attrs = array_merge($def_attrs, $attrs);
        return Html::createTag('optgroup', $attrs, false, $inner_text);
    }

    /**
     * 创建option标签
     * @param string $text     文本
     * @param string $value    值
     * @param bool   $selected 是否选中
     * @param array  $attrs    属性
     * @return string
     */
    public static function option($text = '', $value = '', $selected = false, array $attrs = [])
    {
        $def_attrs = ['value' => $value, 'selected' => $selected];
        $attrs = array_merge($def_attrs, $attrs);
        return Html::createTag('option', $attrs, false, $text);
    }

    /**
     * 创建label标签
     * @param string $text  文本
     * @param string $for   规定 label 绑定到哪个表单元素
     * @param array  $attrs 属性
     * @return string
     */
    public static function label($text, $for = null, array $attrs = [])
    {
        $def_attrs = ['for' => $for];
        $attrs = array_merge($def_attrs, $attrs);
        return Html::createTag('label', $attrs, false, $text);
    }

    /**
     * 创建datalist标签
     * @param string $id        ID
     * @param array  $options   option选项
     * @param array  $attrs     属性
     * @param mixed  $selecteds 选中项，多选以数组形式表示
     * @return string
     */
    public static function datalist($id, array $options, array $attrs = [], $selecteds = null)
    {
        if (is_array($selecteds)) {
            $attrs['multiple'] = true;
        }
        if (is_string($selecteds)) {
            $selecteds = [$selecteds];
        }
        $inner_text = '';
        foreach ($options as $key => $option) {
            if (is_string($key)) {
                $text = $option;
                $value = $key;
                $option_selected = false;
                if (in_array($value, $selecteds)) {
                    $option_selected = true;
                }
                $inner_text .= self::option($text, $value, $option_selected);
            } else {
                $text = isset($option['text']) ? $option['text'] : '';
                $value = isset($option['value']) ? $option['value'] : '';
                $option_selected = isset($option['selected']) ? $option['selected'] : false;
                if (in_array($value, $selecteds)) {
                    $option_selected = true;
                }
                $attrs = isset($option['attrs']) ? $option['attrs'] : [];
                $inner_text .= self::option($text, $value, $option_selected, $attrs);
            }
        }
        $def_attrs = ['id' => $id];
        $attrs = array_merge($def_attrs, $attrs);
        return Html::createTag('datalist', $attrs, false, $inner_text);
    }

    /**
     * 创建keygen标签
     * @param string $name    名称
     * @param string $keytype 定义 keytype。rsa 生成 RSA 密钥。
     * @param array  $attrs   属性
     * @return string
     */
    public static function keygen($name = null, $keytype = 'rsa', array $attrs = [])
    {
        $def_attrs = ['name' => $name, 'keytype' => $keytype];
        $attrs = array_merge($def_attrs, $attrs);
        return Html::createTag('keygen', $attrs, true);
    }

    /**
     * @param null   $name
     * @param mixed  $for   定义输入字段所属的一个或多个表单，多个可以以数组形式传入
     * @param string $text  文本
     * @param array  $attrs 属性
     * @return string
     */
    public static function output($name = null, $for = null, $text = '', array $attrs = [])
    {
        if (is_array($for)) {
            $for = implode(' ', $for);
        }
        $def_attrs = ['name' => $name, 'for' => $for];
        $attrs = array_merge($def_attrs, $attrs);
        return Html::createTag('output', $attrs, false, $text);
    }
}
