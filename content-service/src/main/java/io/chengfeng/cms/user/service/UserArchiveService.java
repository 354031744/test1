package io.chengfeng.cms.user.service;

import io.chengfeng.cms.user.dao.UserArchiveMapper;
import io.chengfeng.cms.domain.ArchiveDO;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;
import org.springframework.stereotype.Service;

import java.util.List;

@Component
@Service
public class UserArchiveService {
    private static final Logger logger =  LoggerFactory.getLogger(UserArchiveService.class);

    @Autowired
    UserArchiveMapper archiveMapper;

    public List<ArchiveDO> getArchiveList(String classify, Integer page, Integer pageSize){
        page = (page-1) * pageSize;
        return archiveMapper.selectArchiveList(classify, page, pageSize);
    }

    public ArchiveDO getArchiveContent(Integer id){
        return archiveMapper.selectArchiveContent(id);
    }
}
