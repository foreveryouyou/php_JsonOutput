# JsonOutput
### 接口返回json简单封装，链式调用

#### 示例
```php
include_once 'JsonOutput.php';
$jop = new JsonOutput();
$jop->out();
// 输出 {"code":0,"msg":"","data":null}


// 构造方法传参，第一个参数为默认code值，[可选]，默认1，
// 第二个参数为输出结果键名数组，[可选]，也可以在对应方法上设置，见下面的例子
$jop = new JsonOutput(0, array('code' => 'returnCode', 'msg' => 'returnMessage', 'data' => 'returnData'));


// 设置具体参数
$jop
    // 第一个参数是返回code值，[可选]，默认1；
    // 第二个参数自定义返回code的键名，[可选]，默认'code'
    ->code(6, 'returnCode')
    // 第一个参数是返回msg值，[可选]，默认''；
    // 第二个参数自定义返回msg的键名，[可选]，默认'msg'
    ->msg('返回信息', 'returnMessage')
    // 第一个参数是返回data值，[可选]，默认null；
    // 第二个参数自定义返回data的键名，[可选]，默认'data'
    ->data(5, 'returnData')
    // 是否不转义斜杠，默认true不转义(仅在php>=5.4)
    ->unEscapedSlashes(true)
    // 是否不转义unicode，默认true不转义(仅在php>=5.4)
    ->unEscapedUnicode(true)
    // 输出json后程序是否exit，默认true
    ->isExit(true)
    // 输出json
    ->out();
// 输出 {"returnCode":6,"returnMessage":"返回信息","returnData":5}
```