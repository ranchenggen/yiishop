<h1>商城模板</h1>
系统包括：
后台：品牌管理、商品分类管理、商品管理、订单管理、系统管理和会员管理六个功能模块。
前台：首页、商品展示、商品购买、订单管理、在线支付等。

<h1>开发环境和技术</h1>
<table>
<tr><td>开发环境</td><td>Window</td></tr>
<tr><td>开发工具</td><td>Phpstorm+PHP5.6+GIT+Apache</td></tr>
<tr><td>相关技术</td><td>Yii2.0+CDN+jQuery+sphinx</td></tr>
</table>


<h1>人员组成</h1>

<table>
<tr><td>职位</td><td>人数</td></tr>
<tr><td>组长</td><td>1</td></tr>
<tr><td>开发人员</td><td>3</td></tr>
<tr><td>UI设计人员</td><td>0</td></tr>
<tr><td>前端开发人员</td><td>1</td></tr>
</table>


<h1>项目周期成本</h1>

<table>
<tr><td>人数</td><td>周期</td><td>负责人员</td></tr>
<tr><td>1</td><td>2周的需求与设计</td><td>项目经理</td></tr>
<tr><td>1</td><td>2周的UI设计</td><td>UI/UE</td></tr>
<tr><td>4</td><td>3个月
                  第1周需求设计
                  9周时间完成编码
                  2周时间进行测试和修复</td><td>开发人员、测试人员</td></tr>

</table>
<h2>11月4号</h2>
<h1>今日进度</h1>
* 文章管理，文章分类的增删改查

<h1>今日难点</h1>
* 多个表联合在一个界面的处理方式
<h1>解决方法</h1>
* index显示  模型用hasOne或者hasMany 视图直接指向该方法
* add,edit 需要用到几个表传几个模型


<h2>11月6号</h2>
<h1>今日进度</h1>
* 分类的增删改查
* 前几日项目的完善

<h1>今日难点</h1>
* 添加分类的父子关系，修改删除时的关系处理,编辑时候选中父类分类和提示不能添加到子节点，添加不选的时候父ID没有
<h1>解决方法</h1>
* 添加分类用插件NestedSets和ztree解决，其中添加父类id用点击事件将选中的ID，赋值给隐藏的父类ID栏实现
* 修改的判定没法修改到自己的子类
* 删除关系判定用finOne查询有没有该ID的父类ID，有就提醒无法删除，没有就正常进行删除
* delect 改成 deleteWithChildren连着子类一起删除