<?php


namespace jdzx\Aws;

use Aws\S3\S3Client;

/**
 * Class Aws
 * @package jdzx\aws
 * @author: Fly
 * @describe:
 */
class Aws
{
    static protected $instance;

    public function __construct()
    {
        if (is_null(self::$instance) || !self::$instance instanceof S3Client) {
            self::$instance = (new S3Client([
                'version'                 => $this->version,
                'region'                  => $this->region,
                'endpoint'                => $this->endpoint,
                'credentials'             => $this->credentials,
                'use_path_style_endpoint' => $this->use_path_style_endpoint,
            ]));
        }
    }

    /**
     * @param $request
     * @param String $field
     * @return array|string
     */
    public function multipleStoragePhoto($request, String $field = 'uploadFile')
    {
        $files = $request->file($field);

        #路径数组
        $keyArr = array();
        $s3     = self::$instance;

        foreach ($files as $photo) {
            if ($photo->isValid()) {

                //文件扩展名
                $extend = $photo->extension();
                # 自定义文件名
                $fileName = date('Ymd') . '-' . uniqid() . '.' . $extend;

                $s3_return = $s3->putObject([
                    'Bucket' => $this->BUCKET, //存储桶名称
                    'Key'    => $fileName, //文件名（包括后缀名）
                    'Body'   => file_get_contents($photo) //要上传的文件
                ]);

                if ($s3_return['@metadata']['statusCode'] == 200) {
                    $keyArr[] = $this->BUCKET . '/' . $fileName;
                } else {
                    return '图片上传失败';
                }
            }
        }

        return $keyArr;
    }


    /**
     * 删除图片
     * @param $url
     * @return mixed
     */
    public function deletePhoto($url)
    {
        $s3   = self::$instance;

        return $s3->deleteObject([
            'Bucket' => $this->BUCKET, //存储桶名称
            'Key'    => strrchr($url, '/'), //文件名 去掉time-management
        ]);

    }


    /**
     * 删除多张图片
     * @param $urls
     */
    public function deletePhotos(array $urls = []): array
    {
        $s3   = self::$instance;
        $keys = [];
        foreach ($urls as $url) {
            $keys[] = array('Key' => strrchr($url, '/'));
        }

        $s3->deleteObjects([
            'Bucket' => $this->BUCKET, //存储桶名称
            'Delete' => ['Objects' => $keys]
        ]);

        return $keys;
    }

    public function __get($key)
    {
        return $this->$key ?? config('jdzx.Aws.' . $key);
    }

    public function __set($key, $value)
    {
        $this->$key = $value;
    }
}