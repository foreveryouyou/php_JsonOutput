<?php
/**
 * Created by PhpStorm.
 * User: ange
 * Date: 17-8-18
 * Time: 下午5:05
 */

class JsonOutput
{
    // 返回结果code值
    private $retCode = 1;
    // 返回信息
    private $retMsg = '';
    // 返回结果数据
    private $retData = null;
    // 返回json的键
    private $retKeys = array(
        'code' => 'code',
        'msg' => 'msg',
        'data' => 'data');
    // 输出json后是否exit，默认true
    private $exit = true;
    // 不转义斜杠
    private $unEscapedSlashes = true;
    // 不转义unicode
    private $unEscapedUnicode = true;
    private $instance;

    /**
     * JsonOutput constructor.
     * @param int $codeDefault 默认返回成功code值
     * @param array $keys 返回json键名，如array('code'=>'retCode','msg'=>'message')
     */
    public function __construct($codeDefault = 1, $keys = array())
    {
        if (!$this->instance) {
            $this->instance = $this;
        }
        $this->retCode = $codeDefault;
        foreach ($this->retKeys as $key => $value) {
            if (isset($keys[$key]) && !empty($keys[$key])) {
                $this->retKeys[$key] = $keys[$key];
            }
        }
        header('Content-type: application/json');
    }

    /**
     * 设置输出结果的code
     * @param int $code code
     * @param string $key code的键名
     * @return JsonOutput
     */
    public function code($code = 1, $key = '')
    {
        $this->retCode = $code;
        $this->retKeys['code'] = empty($key) ? $this->retKeys['code'] : $key;
        return $this->instance;
    }

    /**
     * 设置输出结果的msg
     * @param string $msg msg
     * @param string $key msg的键名
     * @return JsonOutput
     */
    public function msg($msg = '', $key = '')
    {
        $this->retMsg = $msg;
        $this->retKeys['msg'] = empty($key) ? $this->retKeys['msg'] : $key;
        return $this->instance;
    }

    /**
     * 设置输出结果的data
     * @param null $data data
     * @param string $key data的键名
     * @return JsonOutput
     */
    public function data($data = null, $key = '')
    {
        $this->retData = $data;
        $this->retKeys['data'] = empty($key) ? $this->retKeys['data'] : $key;
        return $this->instance;
    }

    /**
     * 设置输出json后是否exit
     * @param bool $exit 默认true，即输出json后exit
     * @return JsonOutput
     */
    public function isExit($exit = true)
    {
        $this->exit = $exit;
        return $this->instance;
    }

    /**
     * 设置是否不转义斜杠（仅在php >= 5.4）
     * @param bool $flg 默认true，不转义斜杠
     * @return JsonOutput
     */
    public function unEscapedSlashes($flg = true)
    {
        $this->unEscapedSlashes = $flg;
        return $this->instance;
    }

    /**
     * 设置是否不转义unicode（仅在php >= 5.4）
     * @param bool $flg 默认true，不转义unicode
     * @return JsonOutput
     */
    public function unEscapedUnicode($flg = true)
    {
        $this->unEscapedUnicode = $flg;
        return $this->instance;
    }

    /**
     * 输出json
     */
    public function out()
    {
        $data = array(
            $this->retKeys['code'] => $this->retCode,
            $this->retKeys['msg'] => $this->retMsg,
            $this->retKeys['data'] => $this->retData
        );
        $options = 0;
        if (defined('JSON_UNESCAPED_SLASHES') && $this->unEscapedSlashes) {
            $options = $options | JSON_UNESCAPED_SLASHES;
        }
        if (defined('JSON_UNESCAPED_UNICODE') && $this->unEscapedUnicode) {
            $options = $options | JSON_UNESCAPED_UNICODE;
        }
	    if ($options != 0) {
		    echo json_encode($data, $options);
	    } else {
		    echo json_encode($data);
	    }
        $this->exit && exit();
    }

}