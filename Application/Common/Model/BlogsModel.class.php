<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/13
 * Time: 18:17
 */

namespace Common\Model;
use \Common\Model\BaseModel;

class BlogsModel extends BaseModel
{


    protected $_validate = array(
       array('cid','require','必须选择分类'),
       array('title','require','必须输入博客标题'),
       array('content','require','必须输入博客内容'),
      // array('content','require','必须输入博客的内容')
     //  array('content','require','必须输入博客的内容'),
    );




    public function getId(){
        $rn = $this->max('id');
        $rn = $rn + 1;
        return $rn;
    }
  //模糊查询根据博客的标题。

   public function selectByTitle($data = array()){
      if (empty ($data)) {
          $rn = $this->selectData();
          return $rn;
      }
      else {
          $val='%'.$data['title'].'%';
          $data['title']=array('like',$val);
          $rn = $this->where($data)->select();
          return $rn;
      }

   }
   /*
    * 返回表格之中的数据的数目
    *
    */
   public function getCount(){
       $rn = $this->count();
       return $rn;
   }
   /*
    * 根据id 获得路径。
    */

   public function selectById($data = array()){

       if (empty($data)) {
           $rn = $this->selectData();
           return $rn;
       }
       else {
           $rn = $this->where($data)->getField('avatar');
           return $rn;
       }
   }

   public function addData(){
       C('DEFAULT_FILTER', 'htmlspecialchars');
       $rn =array(
           'flag' => false,
           'information' => '',
       );
       $data = I('post.');
       $data = $this->delimagepath($data);
      if ($this->create($data)){
          //进行时间的创建
          $this->create_time = time();
          //获得最新的文章的id
          //然后判断文章的插入是否成功
          $bid = $this->add();
          if ($bid) {
              //已经成功获得文章的id
              //然后判断文章是否是具有图片
              $avatar =get_image_url($data['content']);
              if (empty($avatar)) {
                  //文章不具有图片的话，那么这个文章的话，就是已经插入成功了。
                  $rn['flag'] = true;
                  return $rn;
              }
              else {
                  //文章具有图片，接下去的话，就是进行另外一个数据的插入了。
                  $cn['bid'] = $bid;
                  $cn['avas'] =$avatar;
                  $pic= D('Picture');
                  $pn = $pic->addDa($cn);
                  if ($pn){
                      $rn['flag'] = true;
                      return $rn;
                  }
                  else {
                      $rn['information'] = "图片添加失败";
                      return $rn;
                  }
              }
          }
          else {
              //文章添加失败的话，就是返回失误的值
              $rn['information'] = "文章添加失败";
              return $rn;
          }
          $rn['flag'] = $this->add();
         return $rn;
      }
      else {
          $rn['information'] = $this->getError();
          return $rn;

      }


   }


   protected function delimagepath($data)
   {
       $data['content'] = htmlspecialchars_decode($data['content']);
       $image_title_alt_word=C('IMAGE_TITLE_ALT_WORD');
       if(!empty($image_title_alt_word)){
           // 修改图片默认的title和alt
           $data['content']=preg_replace('/title=\"(?<=").*?(?=")\"/','title="月歌博客"',$data['content']);
           $data['content']=preg_replace('/alt=\"(?<=").*?(?=")\"/','alt="月歌博客"',$data['content']);
       }

       $path ='src="'.C('BLOG_IMAGE_PATH');

       // 将绝对路径转换为相对路径
       $data['content'] = preg_replace('/src=\"\/blog\/article\//',$path,$data['content']);

       // 转义
       $data['content']=htmlspecialchars($data['content']);
       return $data;

   }





}