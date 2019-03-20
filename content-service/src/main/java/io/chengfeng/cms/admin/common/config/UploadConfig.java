package io.chengfeng.cms.admin.common.config;

import org.springframework.beans.factory.annotation.Value;
import org.springframework.stereotype.Component;

@Component
public class UploadConfig {
    public static String resourceUrl = "";

    @Value("${api.resourceUrl}")
    public void setResourceUrl(String resourceUrl){
        UploadConfig.resourceUrl = resourceUrl;
    }
}
