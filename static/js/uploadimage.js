$(function(){
    class Upload{
        constructor(url,file,img,load,fun){
            this.file=file;
            this.img=img;
            this.load=load;
            this.size=20*1024*1024;
            this.type=['jpg','jpeg','png','gif'];
            this.flag=true;
            this.form=form;
            this.url=url;
            this.fun=fun;
        }
        uploadimg(){
            let that=this;
            this.file.onchange=function () {
                that.file=this.files[0];
                let filereader=new FileReader();
                filereader.readAsDataURL(that.file);
                that.check();
                filereader.onload=function (e) {
                    if(that.flag){
                        that.img.src=e.target.result;
                        that.upload();
                    }
                }
            }
        }
        check(){
            if(this.file.size>this.size){
                alert('图片太大，请插入20M以下的文件');
                this.flag=false;
                return;
            }
            let zhui=this.file.name.split('.')[1];
            if(this.type.includes(zhui)){
                this.flag=true;
                return;
            }else{
                alert('文件格式不正确');
            }
        }
        upload(){
            let that=this;
            let ajax=new XMLHttpRequest();
            let formdata=new FormData();
            formdata.append('img',this.file);
            ajax.onload=function () {
                that.fun(ajax.responseText);
            }
            ajax.upload.onprogress=function (e) {	//监测加载进度
                let pro=e.loaded/e.total*100;	// 已经加载的进度，全部的大小
                that.load.style.width=pro+"%";

            }
            ajax.open('post',this.url,true);
            ajax.send(formdata);
        }
    }
    let file=document.querySelector('#jl-userphoto');
    let img=document.querySelector('#img');
    let load=document.querySelector('#loading');
    let form=document.querySelector('#form');
    let obj=new Upload('uploadimage.php',file,img,load,function (text) {
        form.value=text;
    });
    obj.uploadimg();
})