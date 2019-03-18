package io.chengfeng.cms.admin.controller;

import com.alibaba.fastjson.JSON;
import io.chengfeng.cms.admin.service.ArcTypeService;
import io.chengfeng.cms.domain.ArcTypeDO;
import io.chengfeng.cms.pojo.ArcTypeCatalog;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/admin/arctype")
public class ArcTypeController {
    private static final Logger logger =  LoggerFactory.getLogger(ArcTypeController.class);

    @Autowired
    ArcTypeService arcTypeService;

    @GetMapping("get_arctype_list")
    public ResponseEntity<ArcTypeCatalog> getArcTypeList(@RequestParam(value = "identifier", defaultValue = "toplevel") String identifier, @RequestParam("layer") Integer layer){
        return ResponseEntity.ok(arcTypeService.getArcTypeInitialize(identifier, layer));
    }

    @PostMapping("add_arctype")
    public ResponseEntity<String> add(ArcTypeDO arcTypeDO){
        System.out.println(JSON.toJSONString(arcTypeDO));
        return ResponseEntity.ok(arcTypeService.addArcType(arcTypeDO));
    }

    @PostMapping("edit_arctype")
    public ResponseEntity<String> edit(ArcTypeDO arcTypeDO){
        return ResponseEntity.ok(arcTypeService.updateArcType(arcTypeDO));
    }

    @PostMapping("delete_arctype")
    public ResponseEntity<String> delete(@RequestParam("id") Integer id){
        return ResponseEntity.ok(arcTypeService.deleteArcType(id));
    }
    @PostMapping("set_arctype_status")
    public ResponseEntity<String> setDisplayStatus(@RequestParam("id") Integer id, @RequestParam("status") Integer status){
        return ResponseEntity.ok(arcTypeService.setDisplayStatus(id, status));
    }
}
