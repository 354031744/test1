package io.chengfeng.cms.admin.controller;

import io.chengfeng.cms.admin.common.ueditor.ActionEnter;
import javafx.application.Application;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;

import javax.servlet.http.HttpServletRequest;
import java.io.UnsupportedEncodingException;

@Controller
@RequestMapping("/admin/ueditor")
public class UEditorController {
    @RequestMapping(value = "exec")
    @ResponseBody
    public String exec(HttpServletRequest request) throws UnsupportedEncodingException {
        request.setCharacterEncoding("utf-8");
        String rootPath = "";
        System.out.println(new ActionEnter(request, rootPath).exec());
        return new ActionEnter(request, rootPath).exec();
    }
}
