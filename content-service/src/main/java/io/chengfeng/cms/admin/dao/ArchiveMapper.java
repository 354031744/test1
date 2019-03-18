package io.chengfeng.cms.admin.dao;

import io.chengfeng.cms.domain.ArchiveDO;
import org.apache.ibatis.annotations.*;
import org.springframework.stereotype.Repository;

import java.util.List;

@Mapper
@Repository
public interface ArchiveMapper {
    @Select({
            "select id, classified_catalogue, title, attribute, thumbnail, status,",
            "articles_source, keyword, `describe`, clicks, author, create_time, update_time",
            "from pf_archive limit #{page}, #{pageSize}"
    })
    List<ArchiveDO> selectArchiveList(@Param("page") Integer page, @Param("pageSize") Integer pageSize);

    @Select({
            "select id, classified_catalogue, title, attribute, thumbnail, content,",
            "articles_source, keyword, `describe`, clicks, status",
            "from pf_archive where id = #{id}"
    })
    ArchiveDO selectArchiveContent(@Param("id") Integer id);

    @Insert({
            "insert into pf_archive(classified_catalogue, title, attribute, thumbnail, content,",
            "membership_level, articles_source, keyword, `describe`, clicks, status, author, create_time, update_time)",
            "values(#{classifiedCatalogue},#{title},#{attribute},#{thumbnail},#{content},",
            "#{membershipLevel},#{articlesSource},#{keyword},#{describe}, 0, #{status}, #{author}, now(), now())"
    })
    void insertArchive(ArchiveDO archive);

    @Update({
            "update pf_archive set classified_catalogue = #{classifiedCatalogue}, title = #{title},",
            "attribute = #{attribute}, thumbnail = #{thumbnail}, content = #{content},",
            "membership_level = #{membershipLevel}, articles_source = #{articlesSource},",
            "keyword = #{keyword}, `describe` = #{describe}, clicks = #{clicks}, status = #{status},",
            "author = #{author}, update_time = now()",
            "where id = #{id}"
    })
    void updateArchive(ArchiveDO archive);

    @Delete({
            "delete from pf_archive where id =#{id}"
    })
    void deleteArchive(@Param("id") Integer id);

    @Update({
            "update pf_archive set status = #{status} where id = #{id}"
    })
    void updateStatus(@Param("id") Integer id, @Param("status") Integer status);
}
