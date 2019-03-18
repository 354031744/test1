package io.chengfeng.cms.admin.service;

import io.chengfeng.cms.admin.dao.ArcTypeMapper;
import io.chengfeng.cms.domain.ArcTypeDO;
import io.chengfeng.cms.pojo.ArcTypeCatalog;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.List;

@Component
@Service
public class ArcTypeService {
    @Autowired
    ArcTypeMapper arcTypeMapper;

    public ArcTypeCatalog getArcTypeInitialize(String identifier, Integer layer){
        List<ArcTypeDO> list;
        list = arcTypeMapper.selectArcTypeCatalog();
        if(list == null){
            return new ArcTypeCatalog();
        }
        return getArcTypeTest(identifier, list, layer);
    }


    public ArcTypeCatalog getArcTypeTest(String identifier, List<ArcTypeDO> list, Integer layer){
        ArcTypeCatalog arcTypeCatalog = new ArcTypeCatalog();
        if(layer == 0){
            return arcTypeCatalog;
        }
        List<ArcTypeCatalog> arcTypeList = new ArrayList<>();
        for (int i = 0; i < list.size(); i++) {
            ArcTypeDO arcTypeDO = list.get(i);
            if(arcTypeDO.getIdentifier().equals(identifier)){
                arcTypeCatalog.setArcType(arcTypeDO);
            }else if(arcTypeDO.getCategoryParent().equals(identifier)){
                ArcTypeCatalog temp = new ArcTypeCatalog();
                temp.setArcTypeList(new ArrayList<>());
                temp.setArcType(arcTypeDO);
                arcTypeList.add(temp);
                list.remove(i);
                --i;
                //查询下一层菜单
                ArcTypeCatalog catalog = getArcTypeTest(arcTypeDO.getIdentifier(), list, layer - 1);
                if(catalog.getArcTypeList() != null){
                    temp.getArcTypeList().addAll(catalog.getArcTypeList());
                }
            }
        }

        arcTypeCatalog.setArcTypeList(arcTypeList);

        return arcTypeCatalog;
    }

    public String addArcType(ArcTypeDO arcTypeDO){
        arcTypeMapper.insertArcType(arcTypeDO);
        return "success";
    }

    public String updateArcType(ArcTypeDO arcTypeDO){
        arcTypeMapper.updateArcType(arcTypeDO);
        return "success";
    }

    public String deleteArcType(Integer id){
        arcTypeMapper.deleteArcType(id);
        return "success";
    }

    public String setDisplayStatus(Integer id, Integer isDisplay){
        arcTypeMapper.setDisplayStatus(id, isDisplay);
        return "success";
    }


}
