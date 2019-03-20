package io.chengfeng.cms.admin.controller;

import io.chengfeng.cms.utils.FileUtil;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.multipart.MultipartFile;

import javax.servlet.http.HttpServletRequest;
import java.util.Date;

@Controller
@RequestMapping("/admin/file")
public class FileController {
    @ResponseBody
    @PostMapping("/upload")
    String upload(@RequestParam("file") MultipartFile file, HttpServletRequest request) {
        String fileName = file.getOriginalFilename();
        fileName = FileUtil.renameToUUID(fileName);
        //FileDO sysFile = new FileDO(FileType.fileType(fileName), "/files/" + fileName, new Date());
        try {
            FileUtil.uploadFile(file.getBytes(), "D:/images/", fileName);
        } catch (Exception e) {
            return "error";
        }

        return "error";
    }
}
