package io.chengfeng.cms;

import com.alibaba.fastjson.JSON;
import io.chengfeng.cms.admin.dao.ArcTypeMapper;
import io.chengfeng.cms.domain.ArcTypeDO;
import io.chengfeng.cms.pojo.ArcTypeCatalog;
import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;

import java.util.ArrayList;
import java.util.List;

@SpringBootTest
@RunWith(SpringJUnit4ClassRunner.class)
public class ArcTypeServiceTest {

    // @Autowired
    // ArcTypeMapper arcTypeMapper;

    // @Test
    // public void getArcTypeList() {
    //     String identifier = "toplevel";
    //     Integer layer = -1;

    //     List<ArcTypeDO> list;
    //     list = arcTypeMapper.selectArcTypeCatalog();
    //     System.out.println(JSON.toJSONString(list));
    //     System.out.println(JSON.toJSONString(getArcTypeTest("content_type", list, -1)));
    // }

    // public ArcTypeCatalog getArcTypeTest(String identifier, List<ArcTypeDO> list, Integer layer){
    //     ArcTypeCatalog arcTypeCatalog = new ArcTypeCatalog();
    //     if(layer == 0){
    //         return arcTypeCatalog;
    //     }
    //     List<ArcTypeCatalog> arcTypeList = new ArrayList<>();
    //     for (int i = 0; i < list.size(); i++) {
    //         ArcTypeDO arcTypeDO = list.get(i);
    //         if(arcTypeDO.getIdentifier().equals(identifier)){
    //             arcTypeCatalog.setArcType(arcTypeDO);
    //         }else if(arcTypeDO.getCategoryParent().equals(identifier)){
    //             ArcTypeCatalog temp = new ArcTypeCatalog();
    //             temp.setArcTypeList(new ArrayList<>());
    //             temp.setArcType(arcTypeDO);
    //             arcTypeList.add(temp);
    //             list.remove(i);
    //             --i;
    //             //查询下一层菜单
    //             ArcTypeCatalog catalog = getArcTypeTest(arcTypeDO.getIdentifier(), list, layer - 1);
    //             if(catalog.getArcTypeList() != null){
    //                 temp.getArcTypeList().addAll(catalog.getArcTypeList());
    //             }
    //         }
    //     }

    //     arcTypeCatalog.setArcTypeList(arcTypeList);

    //     return arcTypeCatalog;
    // }

    // public ArcTypeCatalog getArcType(String identifier, Integer layer) {
    //     if (layer <= 0 && layer != -1) {
    //         return null;
    //     }
    //     ArcTypeCatalog arcType = new ArcTypeCatalog();

    //     ArcTypeDO arcTypeDO = arcTypeMapper.selectArcType(identifier);
    //     if (arcTypeDO == null) {
    //         return null;
    //     }

    //     List<ArcTypeDO> arcTypeList = arcTypeMapper.selectArcTypeList(identifier);
    //     if (arcTypeList == null) {
    //         return null;
    //     }
    //     List<ArcTypeCatalog> arcTypes = new ArrayList<>();
    //     if(layer != -1){
    //         --layer;
    //     }
    //     for (ArcTypeDO item : arcTypeList) {
    //         ArcTypeCatalog temp = getArcType(item.getIdentifier(), layer);
    //         if(temp != null){
    //             arcTypes.add(temp);
    //         }
    //     }
    //     arcType.setArcType(arcTypeDO);
    //     arcType.setArcTypeList(arcTypes);
    //     return arcType;
    // }
}