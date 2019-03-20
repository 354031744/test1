package io.chengfeng.cms.admin.controller;

import com.alibaba.fastjson.JSON;
import io.chengfeng.cms.admin.service.ArchiveService;
import io.chengfeng.cms.domain.ArchiveDO;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/admin/archive")
public class ArchiveController {
    private static final Logger logger =  LoggerFactory.getLogger(ArchiveController.class);

    @Autowired
    ArchiveService archiveService;

    //获取文章列表
    @GetMapping("get_archive_list")
    public ResponseEntity<String> getArchiveList(@RequestParam("page") Integer page, @RequestParam("pageSize") Integer pageSize){
        return ResponseEntity.ok(JSON.toJSONString(archiveService.getArchiveList(page, pageSize)));
    }

    //获取文章内容
    @GetMapping("get_archive_content")
    public  ResponseEntity<String> getArchiveContent(@RequestParam("id") Integer id){
        return ResponseEntity.ok(JSON.toJSONString(archiveService.getArchiveContent(id)));
    }

    //添加文章
    @PostMapping("add_archive")
    public  ResponseEntity<String> addArchive(ArchiveDO archive){
       return ResponseEntity.ok(archiveService.addArchive(archive));
    }

    //编辑文章（更新）
    @PostMapping("edit_archive")
    public ResponseEntity<String> editArchive(ArchiveDO archive){
        return ResponseEntity.ok(archiveService.editArchive(archive));
    }

    //删除文章
    @PostMapping("delete_archive")
    public ResponseEntity<String> deleteArchive(@RequestParam("id") Integer id){
        return ResponseEntity.ok(archiveService.deleteArchive(id));
    }

    //设置文章状态（是否可见）
    @PostMapping("set_archive_status")
    public ResponseEntity<String> setArchiveStatus(@RequestParam("id") Integer id, @RequestParam("status") Integer status){
        return ResponseEntity.ok(archiveService.setArcivchStatus(id, status));
    }
}
