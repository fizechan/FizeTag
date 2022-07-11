<?php

namespace Fize\Tag;

/**
 * 分页显示
 */
class Paginator
{

    /**
     * 居中风格,首补齐,尾不补齐
     */
    const CENTER_LEFT = 1;

    /**
     * 居中风格,首补齐,尾补齐
     */
    const CENTER_LEFT_RIGHT = 2;

    /**
     * 固定风格,不适合大于100的分页
     */
    const FIXED_STYLE = 3;

    /**
     * 魔法风格,自动添加缩减
     */
    const MAGIC_STYLE = 4;

    /**
     * 分页GET参数名
     * @var string
     */
    private $_pageVar = 'p';

    /**
     * 每页记录
     * @var int
     */
    public $PageSize = 10;

    /**
     * 当前页码
     * @var int
     */
    public $PageNow = null;

    /**
     * 总页数
     * @var int
     */
    public $PageCount = 1;

    /**
     * 总记录数
     * @var int
     */
    public $Recordcount = 0;

    /**
     * 分页方式GET/POST(JS方式归到GET)
     * @var string
     */
    public $Method = "GET";

    /**
     * 源代码分行显示分页列表
     * @var bool
     */
    public $LineList = true;

    /**
     * 源代码分行显示下拉列表
     * @var bool
     */
    public $LineSelect = true;

    /**
     * 分页左偏移量
     * @var int
     */
    public $LeftOffSet = 5;

    /**
     * 分页右偏移量
     * @var int
     */
    public $RightOffSet = 5;

    /**
     * 下拉框选项左修饰符
     * @var string
     */
    public $OptionLeft = "";

    /**
     * 下拉框选项右修饰符
     * @var string
     */
    public $OptionRight = "";

    /**
     * 是否默认选中下拉框当前页码值
     * @var bool
     */
    public $OptionSelected = true;

    /**
     * 分页风格
     * @var int
     */
    public $ListMode = 3;

    /**
     * 第一页模型
     * @var string
     */
    private $_first = '<a href="//{URL}//" class="first">{page}</a>-';

    /**
     * 最后页模型
     * @var string
     */
    private $_last = '-<a href="//{URL}//" class="last">{page}</a>';

    /**
     * 上一页模型
     * @var string
     */
    private $_prev = '<a href="//{URL}//" class="prev">&lt;</a>-';

    /**
     * 下一页模型
     * @var string
     */
    private $_next = '=<a href="//{URL}//" class="next">&gt;</a>';

    /**
     * 当前页模型
     * @var string
     */
    private $_nmod = '<a href="//{URL}//" class="now">{page}</a>';

    /**
     * 其他页模型
     * @var string
     */
    private $_amod = '<a href="//{URL}//">{page}</a>';

    /**
     * 跳转框模型
     * @var string
     */
    private $_jump = '<input type="text" id="{input}" size="2" value="{page}" onkeydown="//JS//"/>';

    /**
     * 跳转按钮模型
     * @var string
     */
    private $_button = '<a href="javascript:void(0);" onclick="//JS//">GO</a>';

    /**
     * 下拉框模型
     * @var string
     */
    private $_select = '<select onchange="//JS//">{option}</select>';

    /**
     * 上一组模型
     * @var string
     */
    private $_prevg = '<a href="//{URL}//" class="prevg">&lt;&lt;</a>--';

    /**
     * 下一组模型
     * @var string
     */
    private $_nextg = '--<a href="//{URL}//" class="nextg">&gt;&gt;</a>';

    /**
     * 强制显示第一页
     * @var bool
     */
    private $_forcedFirst = false;

    /**
     * 强制显示最后页
     * @var bool
     */
    private $_forcedLast = false;

    /**
     * 强制显示上一页
     * @var bool
     */
    private $_forcedPrev = false;

    /**
     * 强制显示下一页
     * @var bool
     */
    private $_forcedNext = false;

    /**
     * 跳转输入框ID
     * @var string
     */
    private $_inputId = 'page';

    /**
     * 强制显示上一组链接
     * @var bool
     */
    private $_forcedPrevG = false;

    /**
     * 强制显示下一组链接
     * @var bool
     */
    private $_forcedNextG = false;

    /**
     * 链接模型
     * @var string
     */
    private $_hrefModel = "";

    /**
     * 链接分页识别符
     * @var string
     */
    private $_identifier = "{p}";

    /**
     * 分页模版
     * @var string
     */
    private $_model = "{first}{prev}{list}{next}{last}--{jump}--{button}--{select}--{prevg}--{nextg}";

    /**
     * 构造函数
     * @param string $var        分页参数名
     * @param string $target     目标页面链接
     * @param string $identifier 页码数标识
     * @param string $method     分页方式
     */
    public function __construct($var = null, $target = null, $identifier = null, $method = null)
    {
        if (!empty($var)) {
            $this->_pageVar = $var;
        }
        if (!empty($method)) {
            $this->Method = $method;
        }
        switch ($this->Method) {
            case 'GET' :
                $this->PageNow = $_GET[$this->_pageVar];
                break;
            case 'POST' :
                $this->PageNow = $_POST[$this->_pageVar];
                break;
            default :
                //nothing
        }
        $this->setTarget($target, $identifier);
    }

    /**
     * 设置目标页面
     * @param string $target     目标页面
     * @param string $identifier 页码数标识
     */
    public function setTarget($target, $identifier = null)
    {
        if (!is_null($identifier)) {
            $this->_identifier = $identifier;
        }
        if (is_null($target)) {
            //当前页
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $target = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            //自构建URL，本功能仅适用于标准URL，伪静态URL请直接传入target表达式
            $ar1 = explode("?", $target);
            if (count($ar1) == 2) {
                $tag = $ar1[0];
                $par = "";
                $pts = explode("&", $ar1[1]);
                foreach ($pts as $pt) {
                    $has = explode("=", $pt);
                    if (count($has) == 2) {
                        $val = urldecode($has[1]);
                        if ($has[0] == $this->_pageVar) {
                            $val = $this->_identifier;
                        }
                        if (empty($par)) {
                            $par = $has[0] . "=" . $val;
                        } else {
                            $par .= "&" . $has[0] . "=" . $val;
                        }
                    }
                }
                $target = $tag . "?" . $par;
            }
        }
        //允许未传入identifier的情况,仅适用于标准URL，伪静态URL请直接传入target完整表达式
        if (strpos(urlencode(urldecode($target)), urlencode($this->_identifier)) === false) {
            if (strpos($target, "?") === false) {
                $target .= "?" . $this->_pageVar . "=" . $this->_identifier;
            } else {
                $target .= "&" . $this->_pageVar . "=" . $this->_identifier;
            }
        } else {
            //将encode的部分格式化
            $target = str_replace(urlencode($this->_identifier), $this->_identifier, $target);
        }
        //var_dump($target);
        $this->_hrefModel = $target;
    }

    /**
     * 魔法设置只读参数
     * @param string $name  参数名
     * @param mixed  $value 参数值
     * @return boolean
     */
    public function setConfig($name, $value)
    {
        $can = [
            'inputId',
            'first', 'last', 'prev', 'next', 'nmod', 'amod', 'jump', 'button', 'select', 'prevg', 'nextg'
        ];
        if (in_array($name, $can)) {
            $name = '_' . $name;
            $this->$name = $value;
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取相关模版是否强制显示(无意义)
     * @param string $name 模型名
     * @return boolean
     */
    public function getForced($name)
    {
        $can = ['First', 'Last', 'Prev', 'Next', 'PrevG', 'NextG'];
        if (in_array($name, $can)) {
            $name = '_forced' . $name;
            return $this->$name;
        } else {
            return false;
        }
    }

    /**
     * 设置相关模版是否强制显示
     * @param string $name  模型名
     * @param bool   $value 是否强制显示
     * @return boolean
     */
    public function setForced($name, $value)
    {
        $can = ['First', 'Last', 'Prev', 'Next', 'PrevG', 'NextG'];
        if (in_array($name, $can)) {
            $name = '_forced' . $name;
            $this->$name = $value;
            return true;
        } else {
            return false;
        }
    }

    /**
     * 确认当前页码可以使用
     */
    private function makeSureNP_()
    {
        if (is_int($this->PageNow + 0) && $this->PageNow > 0) {
            $this->PageNow = (int)$this->PageNow;
        } else {
            $this->PageNow = 1;
        }
        if ($this->PageNow > $this->PageCount) {
            $this->PageNow = $this->PageCount;
        }
    }

    /**
     * 通过格式化未拆分的数组来初始化当前分页
     * @param array $array
     * @return array
     */
    public function formatArray($array)
    {
        $this->makeSureNP_();
        $this->Recordcount = count($array);
        $this->PageCount = (int)floor($this->Recordcount / $this->PageSize);
        return array_slice($array, $this->PageNow * $this->PageSize, $this->PageSize);
    }

    /**
     * 获取指定页的相应链接
     * @param int $page 指定页码
     * @return string
     */
    private function hrefForPage_($page)
    {
        return str_replace($this->_identifier, $page, $this->_hrefModel);
    }

    /**
     * 设置分页模版
     * @param string $model 模板字符串
     */
    public function setModel($model)
    {
        $this->_model = $model;
    }

    /**
     * 返回分页字符串
     * @param int $model 指定输出风格，仅本次有效
     * @return string
     */
    public function render($model = null)
    {
        $this->makeSureNP_();
        $model = is_null($model) ? $this->ListMode : $model;
        switch ($model) {
            case self::CENTER_LEFT :
                //居中风格,首补齐,尾不补齐
                $t_b = $this->PageNow - $this->LeftOffSet;
                $t_e = $this->PageNow + $this->RightOffSet;
                if ($this->PageNow - $this->LeftOffSet < 1) {
                    $t_b = 1;
                    $t_e = $this->LeftOffSet + $this->RightOffSet + 1;
                }
                break;
            case self::CENTER_LEFT_RIGHT :
                //居中风格,首补齐,尾补齐
                $t_b = $this->PageNow - $this->LeftOffSet;
                $t_e = $this->PageNow + $this->RightOffSet;
                if ($this->PageNow - $this->LeftOffSet < 1) {
                    $t_b = 1;
                    $t_e = $this->LeftOffSet + $this->RightOffSet + 1;
                } elseif ($this->PageNow + $this->RightOffSet > $this->PageCount) {
                    $t_b = $this->PageCount - $this->LeftOffSet - $this->RightOffSet;
                    $t_e = $this->PageCount;
                }
                break;
            case self::FIXED_STYLE :
                //固定风格,不适合大于100的分页
                $t_t = $this->LeftOffSet + $this->RightOffSet;
                $t_t = (int)floor($this->PageNow / $t_t) * $t_t;
                $t_b = $t_t;
                $t_e = $t_t + $this->LeftOffSet + $this->RightOffSet;
                break;
            case self::MAGIC_STYLE :
                //魔法风格,自动添加缩减
                $t_t = 2 * strlen((string)$this->PageNow) - 4;
                $t_l = $this->LeftOffSet - $t_t;
                $t_r = $this->RightOffSet - $t_t;
                $t_b = $this->PageNow - $t_l;
                $t_e = $this->PageNow + $t_r;
                if ($this->PageNow - $t_l < 1) {
                    $t_b = 1;
                    $t_e = $this->LeftOffSet + $this->RightOffSet + 1;
                }
                break;
            default :
                //固定风格,坚持按实际参数执行
                $t_b = $this->PageNow - $this->LeftOffSet;
                $t_e = $this->PageNow + $this->RightOffSet;
        }
        $t_s = "";
        for ($t_i = $t_b; $t_i <= $t_e; $t_i++) {
            if ($t_i > 0 && $t_i <= $this->PageCount) {
                if ($t_i == $this->PageNow) {
                    $t_s .= str_replace("{page}", $t_i, str_replace("//{URL}//", $this->hrefForPage_($t_i), $this->_nmod));
                } else {
                    $t_s .= str_replace("{page}", $t_i, str_replace("//{URL}//", $this->hrefForPage_($t_i), $this->_amod));
                }
                if ($this->LineList && $t_i != $t_e) {
                    $t_s .= PHP_EOL;
                }
            }
        }
        $t_o = str_replace("{list}", $t_s, $this->_model);
        //第一页
        if ($this->_forcedFirst || $t_b > 1) {
            if (strpos($this->_model, "{first}") === false) {
                $t_o = str_replace("{first}", "", $t_o);
            } else {
                $t_o = str_replace("{first}", str_replace("{page}", 1, str_replace("//{URL}//", $this->hrefForPage_(1), $this->_first)), $t_o);
            }
        } else {
            $t_o = str_replace("{first}", "", $t_o);
        }
        //最后页
        if ($this->_forcedLast || $t_e < $this->PageCount) {
            if (strpos($this->_model, "{last}") === false) {
                $t_o = str_replace("{last}", "", $t_o);
            } else {
                $t_o = str_replace("{last}", str_replace("{page}", $this->PageCount, str_replace("//{URL}//", $this->hrefForPage_($this->PageCount), $this->_last)), $t_o);
            }
        } else {
            $t_o = str_replace("{last}", "", $t_o);
        }
        //上一页
        if ($this->_forcedPrev || $this->PageNow > 1) {
            if (strpos($this->_model, "{prev}") === false) {
                $t_o = str_replace("{prev}", "", $t_o);
            } else {
                $t_o = str_replace("{prev}", str_replace("{page}", (string)($this->PageNow - 1), str_replace("//{URL}//", $this->hrefForPage_($this->PageNow - 1), $this->_prev)), $t_o);
            }
        } else {
            $t_o = str_replace("{prev}", "", $t_o);
        }
        //下一页
        if ($this->_forcedNext || $this->PageNow < $this->PageCount) {
            if (strpos($this->_model, "{next}") === false) {
                $t_o = str_replace("{next}", "", $t_o);
            } else {
                $t_o = str_replace("{next}", str_replace("{page}", (string)($this->PageNow + 1), str_replace("//{URL}//", $this->hrefForPage_($this->PageNow + 1), $this->_next)), $t_o);
            }
        } else {
            $t_o = str_replace("{next}", "", $t_o);
        }
        //上一组
        if ($this->_forcedPrevG || $this->PageNow - $this->LeftOffSet > 0) {
            if (strpos($this->_model, "{prevg}") === false) {
                $t_o = str_replace("{prevg}", "", $t_o);
            } else {
                $t_o = str_replace("{prevg}", str_replace("{page}", (string)($this->PageNow - $this->LeftOffSet), str_replace("//{URL}//", $this->hrefForPage_($this->PageNow - $this->LeftOffSet), $this->_prevg)), $t_o);
            }
        } else {
            $t_o = str_replace("{prevg}", "", $t_o);
        }
        //下一组
        if ($this->_forcedNextG || $this->PageNow + $this->RightOffSet <= $this->PageCount) {
            if (strpos($this->_model, "{nextg}") === false) {
                $t_o = str_replace("{nextg}", "", $t_o);
            } else {
                $t_o = str_replace("{nextg}", str_replace("{page}", (string)($this->PageNow + $this->RightOffSet), str_replace("//{URL}//", $this->hrefForPage_($this->PageNow + $this->RightOffSet), $this->_nextg)), $t_o);
            }
        } else {
            $t_o = str_replace("{nextg}", "", $t_o);
        }
        //跳转框
        if (strpos($this->_model, "{jump}") !== false) {
            $t_s = "javascript:if(event.keyCode==13){var url='" . $this->_hrefModel . "';location=url.replace('" . $this->_identifier . "',this.value);return false;}";
            $t_o = str_replace("{jump}", str_replace("//{JS}//", $t_s, str_replace("{page}", $this->PageNow, str_replace("{input}", $this->_inputId, $this->_jump))), $t_o);
        }
        //跳转按钮
        if (strpos($this->_model, "{button}") !== false) {
            $t_s = "javascript:var url='" . $this->_hrefModel . "';location=url.replace('" . $this->_identifier . "',document.getElementById('" . $this->_inputId . "').value);return false;";
            $t_o = str_replace("{button}", str_replace("//{JS}//", $t_s, str_replace("{page}", $this->PageNow, str_replace("{input}", $this->_inputId, $this->_button))), $t_o);
        }
        //下拉框
        if (strpos($this->_model, "{select}") !== false) {
            $t_t = "javascript:var url='" . $this->_hrefModel . "';location=url.replace('" . $this->_identifier . "',this.value);return false;";
            $t_s = str_replace("//{JS}//", $t_t, $this->_select);
            //处理option
            $t_t = "";
            for ($t_i = 1; $t_i <= $this->PageCount; $t_i++) {
                if ($t_i == $this->PageNow && $this->OptionSelected) {
                    $t_t .= '<option selected="selected" value="' . $t_i . '">' . $this->OptionLeft . $t_i . $this->OptionRight . '</option>';
                } else {
                    $t_t .= '<option value="' . $t_i . '">' . $this->OptionLeft . $t_i . $this->OptionRight . '</option>';
                }
                if ($this->LineSelect) {
                    $t_t .= PHP_EOL;
                }
            }
            $t_s = str_replace("{option}", PHP_EOL . $t_t, $t_s);
            $t_o = str_replace("{select}", $t_s, $t_o);
        }
        return $t_o;
    }
}
