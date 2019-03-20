package io.chengfeng.cms.user.dao;

import io.chengfeng.cms.domain.ArchiveDO;
import org.apache.ibatis.annotations.*;
import org.springframework.stereotype.Repository;

import java.util.List;

@Mapper
@Repository
public interface UserArchiveMapper {
    @Select({
            "select id, classified_catalogue, title, attribute, thumbnail,",
            "articles_source, keyword, `describe`, clicks, author, create_time",
            "from pf_archive where classified_catalogue = #{classifiedCatalogue} and status = 1 limit #{page}, #{pageSize}"
    })
    List<ArchiveDO> selectArchiveList(@Param("classifiedCatalogue") String classifiedCatalogue,
                                      @Param("page") Integer page, @Param("pageSize") Integer pageSize);

    @Select({
            "select id, classified_catalogue, title, attribute, thumbnail, content,",
            "articles_source, keyword, `describe`, clicks",
            "from pf_archive where id = #{id}"
    })
    ArchiveDO selectArchiveContent(@Param("id") Integer id);
}
