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

   public function addData($data){
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

  //根据传入的条件获取对应的文章的信息
    public function getBlogInformation($map){

       $data =  $this->where($map)->find();
       return $data;

    }

    public function editData(){
        C('DEFAULT_FILTER', 'htmlspecialchars');
        $rn =array(
            'flag' => false,
            'information' => '',
        );
        $data = I('post.');

        //对博客之中的图片进行处理
        $data = $this->delimagepath($data);
        


        //查看进行更新的是否是正确
        if ($this->create($data)) {
            //设置更新时间
            $data['update_time'] = time();
            //对文章进行更新
            $bid = $this->save($data);

            //然后就是判断是否对文章的图片进行了修改。
            if ($bid) {
                //已经成功获得文章的id
                //然后判断文章是否是具有图片
                $avatar =get_image_url($data['content']);


                //获得更新之后文章是否存在图片。
                 $pic = D('Picture');
                 $bd['bid'] = $data['id'];
                 //查询博客之中的所有图片。
                 $da = $pic->where($bd)->select();

                 //原本博客之中就是没有图片
                 if ( empty($da) ) {

                     //如果修改之后，博客还是没有图片
                     if (empty($avatar)) {
                          $rn['flag'] = true;
                          $rn['information'] = '博客修改成功';

                     }
                     else {
                         //原来的博客之中没有图片，但是修改之舟增加了图片
                         $cn['bid'] = $data['id'];
                         $cn['avas'] =$avatar;
                         $pn = $pic->addDa($cn);
                         if ($pn) {
                             $rn['flag'] = true;
                             $rn['information'] = '博客修改成功ss';

                         }
                         else {
                             $rn['flag'] = false;
                             $rn['information'] = '博客修改失败，在于图片';
                         }
                     }
                     return $rn;
                 }//原来的博客之中具有图片。
                 else {

                     //如果修改之中的博客之中没有图片
                     if (empty( $avatar )) {
                         //首先删除数据库之中的数据
                         $cn['bid'] = $data['id'];
                         $rd = $pic->where($cn)->delete();
                         //判断删除的结果
                         if ($rd ) {
                             //接着就是删除原来博客存储的图片了
                             foreach($da as $key => $value ) {
                                 unlink($da[$key]['avatar']);
                             }
                             $rn['flag'] = true;
                             $rn['information'] = '博客修改成功';

                         }
                         else {
                             $rn['flag'] = true;
                             $rn['information'] = '博客修改成功';
                         }
                         return $rn ;
                     }
                     else {//修改的博客之中具有图片
                         //感觉应该是判定两者之间的值是否是具有相同的。
                         $tp =array();//获取原来所有的图片的路径。
                         $tmp = array();
                         foreach( $da as $key => $value){
                             $tp[] = $value['avatar'];
                         }
                         //插入的图片与原来的图片不相同的
                         $ar = array_diff($avatar,$tp);
                         //原来博客图片被删除的。
                         $br = array_diff($tp,$avatar);
                         $cn['bid'] = $data['id'];
                         //博客的图片没有被删除


                         //原来的图片没有被删除，但是也没有新增
                         if ( empty($br) && empty($ar) ) {
                             $rn['flag'] = true;
                             $rn['information'] = '博客修改成功';
                         }
                         elseif (empty($br) && !empty($ar) ){//原来的图片没有被删除，但是新增了图片
                              foreach ($ar as $key => $value) {
                                   $tmp[] = array(
                                                     'bid' => $cn['bid'],
                                                     'avatar' => $value,
                                                  );
                              }
                             $bt = $pic->addAll($tmp);

                              if ($bt) {
                                  $rn['flag'] = true;
                                  $rn['information'] = '博客修改成功';
                              }
                              else {
                                  $rn['flag'] = false;
                                  $rn['information'] = '博客修改成功';
                              }
                              return $rn ;

                         }
                         elseif( !empty($br) && empty($ar) ) { //原来的图片被删除了，但是没有新增图片
                             //当然就是将数据库里面存储的图片记录删除，
                             //以及删除在磁盘上面的图片。
                             $ba['avatar'] = array('in',$br);
                             $bt = $pic->where($ba)->delete();
                             if ($bt) {
                                 foreach($br as $key =>$value){
                                     unlink($value);
                                 }
                                 $rn['flag'] = true;
                                 $rn['information'] = '博客修改成功';
                             }
                             else {
                                 $rn['flag'] = false;
                                 $rn['information'] = '博客修改成功';
                             }
                             return $rn ;
                         }
                         else {//原来的博客的图片图片被删除了，但是同时又新增了图片。
                             //删除原来博客之中的图片
                             $ba['avatar'] = array('in',$br);
                             $bt = $pic->where($ba)->delete();
                             if ($bt) {
                                 //删除原来的磁盘上的图片
                                 foreach($br as $key =>$value) {
                                     unlink($value);
                                 }
                                 //开始新增图片
                                 foreach ($ar as $key => $value) {
                                     $tmp[] = array(
                                         'bid' => $cn['bid'],
                                         'avatar' => $value,
                                     );
                                 }
                                 $bt = $pic->addAll($tmp);

                                 if ($bt) {
                                     $rn['flag'] = true;
                                     $rn['information'] = '博客修改成功';
                                 }
                                 else {
                                     $rn['flag'] = false;
                                     $rn['information'] = '博客修改失败';
                                 }
                                 return $rn;
                             }
                             else {
                                 $rn['flag'] = false;
                                 $rn['information'] = '博客修改失败';
                                 return $rn;
                             }
                         }
                     }
                 }
            }
        }
        else {
            //对于这个的话，到底是怎么处理？
            $rn['flag'] = false;
            $rn['information'] = '修改之后，博客成为了空的博客，如果想要删除的话，请删除博客';
            return $rn;

        }

    }

    //获得符合条件的记录的数目
    public function getCou($data){
        $data['title'] = '%' . $data['title'] . '%';
        $map['title'] = array('like',$data['title']);
        $rn = $this->where($map)->select();
        return count($rn);
    }


public function  selectDataByTitle($data,$p){
        $data['title'] = '%' . $data['title'] . '%';
        $map['title'] = array('like',$data['title']);

        $list = $this->where($map)->order('id')->limit($p->firstRow, $p->listRows)->select();
        return $list;
}

//删除所有

 public function deleteAll($data){
    $rn = array();
    $rn['flag'] = false;
    $pic = D('Picture');
    $map['id'] = array('in',$data);
    $mbp['bid'] = array('in',$data);
    $this->startTrans();
    $ch = $this->where($map)->delete();
    if (! $ch) {
        $this->rollback();
        $rn['information'] = '删除博客失败了';
        return $rn;
    }
     $da = $pic->where($mbp)->select();
     $pic->where($mbp)->delete();

     $this->commit();
     $rn['flag'] = true;
     $rn['information'] = '删除博客成功';
     $rn['da'] = $da;
     return $rn;

 }



}
