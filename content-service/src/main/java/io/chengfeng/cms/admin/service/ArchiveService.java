package io.chengfeng.cms.admin.service;

import io.chengfeng.cms.admin.dao.ArchiveMapper;
import io.chengfeng.cms.domain.ArchiveDO;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;
import org.springframework.stereotype.Service;

import java.util.List;

@Component
@Service
public class ArchiveService {
    private static final Logger logger =  LoggerFactory.getLogger(ArchiveService.class);

    @Autowired
    ArchiveMapper archiveMapper;

    public List<ArchiveDO> getArchiveList(Integer page, Integer pageSize){
        page = (page-1) * pageSize;
        return archiveMapper.selectArchiveList(page, pageSize);
    }

    public ArchiveDO getArchiveContent(Integer id){
        return archiveMapper.selectArchiveContent(id);
    }

    public String addArchive(ArchiveDO archive){
        archiveMapper.insertArchive(archive);
        return "success";
    }

    public String editArchive(ArchiveDO archive){
        archiveMapper.updateArchive(archive);
        return "success";
    }

    public String deleteArchive(Integer id){
        archiveMapper.deleteArchive(id);
        return "success";
    }

    public String setArcivchStatus(Integer id, Integer status){
        archiveMapper.updateStatus(id, status);
        return "success";
    }

}
