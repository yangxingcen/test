/**
 * Created by Administrator on 2017/12/13 0013.
 */
/*编辑器 1*/
    var ue = UE.getEditor('editor',{
            toolbars: [[
                'fullscreen', 'source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                'directionalityltr', 'directionalityrtl', 'indent', '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                'simpleupload', 'insertimage', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'pagebreak', 'template', 'background', '|',
                'horizontal', 'spechars', 'snapscreen', 'wordimage', '|',
                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
                'preview', 'searchreplace',
            ]],
            elementPathEnabled:false,
            autoHeightEnabled:false,
            initialFrameHeight:500,
        });
/*编辑器 2*/
$("#btn-submit").click(function () {

})

/*确认提交 1*/
function J_Confirm() {
    var post = {};
    post.title =  $("input[name='u_title']").val();
    post.detail = UE.getEditor('editor').getContent();
    post.id = $("#update_id").val();   
    
    $.post('/Admin/Userprotocol/update',post, function (res) {
        if (res.status) {
            dialog.showTips(res.info, "warn", function () {
                window.location.reload();
            });
        } else {
            dialog.showTips(res.info, "warn");
        }
    })
}
/*确认提交 2*/