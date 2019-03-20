package io.chengfeng.cms.pojo;

import io.chengfeng.cms.domain.ArcTypeDO;

import java.util.List;

public class ArcTypeCatalog {
    private ArcTypeDO arcType;
    private List<ArcTypeCatalog> arcTypeList;

    public ArcTypeDO getArcType() {
        return arcType;
    }

    public void setArcType(ArcTypeDO arcType) {
        this.arcType = arcType;
    }

    public List<ArcTypeCatalog> getArcTypeList() {
        return arcTypeList;
    }

    public void setArcTypeList(List<ArcTypeCatalog> arcTypeList) {
        this.arcTypeList = arcTypeList;
    }
}
