package io.chengfeng.cms.admin.dao;

import io.chengfeng.cms.domain.ArcTypeDO;
import org.apache.ibatis.annotations.*;
import org.springframework.stereotype.Repository;

import java.util.List;

@Mapper
@Repository
public interface ArcTypeMapper {
    @Select({
            "select id, classification_name, classification_model, category_parent, keyword, classified_catalogue, `order`,",
            "is_display, list_mode, content_mode, identifier, comments, display_mode,classification_icon " ,
            "from pf_arctype"
    })
    List<ArcTypeDO> selectArcTypeCatalog();

    @Select({
            "select id, classification_name, classification_model, category_parent, keyword, classified_catalogue, `order`,",
            "is_display, list_mode, content_mode, identifier, comments, display_mode,classification_icon ",
            "from pf_arctype where identifier = #{identifier}"
    })
    ArcTypeDO selectArcType(@Param("identifier") String identifier);

    @Select({
            "select id, classification_name, classification_model, category_parent, keyword, classified_catalogue, `order`,",
            "is_display, list_mode, content_mode, identifier, comments, display_mode,classification_icon ",
            "from pf_arctype where category_parent = #{categoryParent}"
    })
    List<ArcTypeDO> selectArcTypeList(@Param("categoryParent") String categoryParent);

    @Insert({
            "insert into pf_arctype(classification_name, is_display, `order`, category_parent, classification_model,",
            "classified_catalogue, keyword, comments, display_mode, classification_icon, list_mode, content_mode, identifier) ",
            "values(#{classificationName}, #{isDisplay}, #{order}, #{categoryParent}, #{classificationModel},",
            "#{classifiedCatalogue}, #{keyword}, #{comments}, #{displayMode}, #{classificationIcon}, #{listMode}, #{contentMode}, #{identifier})"
    })
    void insertArcType(ArcTypeDO arcTypeDO);

    @Update({
            "update pf_arctype set classification_name = #{classificationName}, is_display = #{isDisplay}, `order` = #{order}, category_parent = #{categoryParent},",
            "classification_model = #{classificationModel}, list_mode = #{listMode}, content_mode = #{contentMode},",
            "classified_catalogue = #{classifiedCatalogue}, keyword = #{keyword}, comments = #{comments}, display_mode = #{displayMode},",
            "classification_icon = #{classificationIcon}, identifier = #{identifier}",
            "where id = #{id}"
    })
    void updateArcType(ArcTypeDO arcTypeDO);

    @Update({
            "update pf_arctype set is_display = #{isDisplay} where id = #{id}"
    })
    void setDisplayStatus(@Param("id") Integer id, @Param("isDisplay") Integer isDisplay);

    @Delete({
            "delete from pf_arctype where id = #{id}"
    })
    void deleteArcType(@Param("id") Integer id);
}
