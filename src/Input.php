<?php

namespace Fize\Tag;

/**
 * 输入框标签
 */
class Input
{

    /**
     * 定义可点击按钮
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function button($name = null, $value = '', array $attrs = [])
    {
        return self::input('button', $name, $value, $attrs);
    }

    /**
     * 定义复选框
     * @param string $name    名称
     * @param string $value   值
     * @param bool   $checked 是否默认选中
     * @param array  $attrs   属性
     * @return string
     */
    public static function checkbox($name = null, $value = '', $checked = false, array $attrs = [])
    {
        $def_attrs = ['checked' => $checked];
        $attrs = array_merge($def_attrs, $attrs);
        return self::input('checkbox', $name, $value, $attrs);
    }

    /**
     * 定义文件上传控件
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function file($name = null, $value = '', array $attrs = [])
    {
        return self::input('file', $name, $value, $attrs);
    }

    /**
     * 定义隐藏的输入字段
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function hidden($name = null, $value = '', array $attrs = [])
    {
        return self::input('hidden', $name, $value, $attrs);
    }

    /**
     * 定义图像形式的提交按钮
     * @param string $src   图像的URL
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function image($src, $name = null, $value = '', array $attrs = [])
    {
        $def_attrs = ['src' => $src];
        $attrs = array_merge($def_attrs, $attrs);
        return self::input('image', $name, $value, $attrs);
    }

    /**
     * 定义密码字段
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function password($name = null, $value = '', array $attrs = [])
    {
        return self::input('password', $name, $value, $attrs);
    }

    /**
     * 定义单选按钮
     * @param string $name    名称
     * @param string $value   值
     * @param bool   $checked 是否默认选中
     * @param array  $attrs   属性
     * @return string
     */
    public static function radio($name = null, $value = '', $checked = false, array $attrs = [])
    {
        $def_attrs = ['checked' => $checked];
        $attrs = array_merge($def_attrs, $attrs);
        return self::input('radio', $name, $value, $attrs);
    }

    /**
     * 定义重置按钮
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function reset($name = null, $value = '', array $attrs = [])
    {
        return self::input('reset', $name, $value, $attrs);
    }

    /**
     * 定义提交按钮
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function submit($name = null, $value = '', array $attrs = [])
    {
        return self::input('submit', $name, $value, $attrs);
    }

    /**
     * 定义单行的输入字段
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function text($name = null, $value = '', array $attrs = [])
    {
        return self::input('text', $name, $value, $attrs);
    }

    /**
     * email 类型用于应该包含 e-mail 地址的输入域
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function email($name = null, $value = '', array $attrs = [])
    {
        return self::input('email', $name, $value, $attrs);
    }

    /**
     * url 类型用于应该包含 url 地址的输入域
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function url($name = null, $value = '', array $attrs = [])
    {
        return self::input('url', $name, $value, $attrs);
    }

    /**
     * number 类型用于应该包含数值的输入域
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function number($name = null, $value = '', array $attrs = [])
    {
        return self::input('number', $name, $value, $attrs);
    }

    /**
     * range 类型用于应该包含一定范围内数字值的输入域。
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function range($name = null, $value = '', array $attrs = [])
    {
        return self::input('range', $name, $value, $attrs);
    }

    /**
     * 选取日、月、年
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function date($name = null, $value = '', array $attrs = [])
    {
        return self::input('date', $name, $value, $attrs);
    }

    /**
     * 选取月、年
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function month($name = null, $value = '', array $attrs = [])
    {
        return self::input('month', $name, $value, $attrs);
    }

    /**
     * 选取周和年
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function week($name = null, $value = '', array $attrs = [])
    {
        return self::input('week', $name, $value, $attrs);
    }

    /**
     * 选取时间（小时和分钟）
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function time($name = null, $value = '', array $attrs = [])
    {
        return self::input('time', $name, $value, $attrs);
    }

    /**
     * 选取时间、日、月、年（UTC 时间）
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function datetime($name = null, $value = '', array $attrs = [])
    {
        return self::input('datetime', $name, $value, $attrs);
    }

    /**
     * 选取时间、日、月、年（本地时间）
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function datetimeLocal($name = null, $value = '', array $attrs = [])
    {
        return self::input('datetime-local', $name, $value, $attrs);
    }

    /**
     * search 类型用于搜索域
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    public static function search($name = null, $value = '', array $attrs = [])
    {
        return self::input('search', $name, $value, $attrs);
    }

    /**
     * 创建input标签
     * @param string $type  类型
     * @param string $name  名称
     * @param string $value 值
     * @param array  $attrs 属性
     * @return string
     */
    protected static function input($type, $name = null, $value = '', array $attrs = [])
    {
        return Form::input($type, $name, $value, $attrs);
    }
}
