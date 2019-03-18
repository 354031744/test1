package io.chengfeng.cms.admin.controller;

import org.springframework.stereotype.Component;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/admin/system")
public class SystemController {
    @GetMapping("test")
    public String setFriendshiplink(){
        return "test11"
    }
}
