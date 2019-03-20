package io.chengfeng.cms.user.controller;

import com.alibaba.fastjson.JSON;
import io.chengfeng.cms.user.service.UserArchiveService;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/user/archive")
public class UserArchiveController {
    private static final Logger logger =  LoggerFactory.getLogger(UserArchiveController.class);

    @Autowired
    UserArchiveService userArchiveService;

    @GetMapping("get_archive_list")
    public ResponseEntity<String> getArchiveList(@RequestParam("classify") String classify, @RequestParam("page") Integer page,
                                                 @RequestParam("pageSize") Integer pageSize){
        return ResponseEntity.ok(JSON.toJSONString(userArchiveService.getArchiveList(classify, page, pageSize)));
    }

    @GetMapping("get_archive_content")
    public  ResponseEntity<String> getArchiveContent(@RequestParam("id") Integer id){
        return ResponseEntity.ok(JSON.toJSONString(userArchiveService.getArchiveContent(id)));
    }
}
