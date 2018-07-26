<?php
declare(strict_types=1);

namespace WShafer\PSR11FlySystem\Adaptor;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use WShafer\PSR11FlySystem\FactoryInterface;

class S3AdapterFactory implements FactoryInterface
{
    public function __invoke(array $options)
    {
        $options = array_replace([
            'key' => null,
            'secret' => null,
            'region' => 'us-east-1',
            'version' => 'latest',
            'bucket' => null,
            'prefix' => null,
        ], $options);

        $bucket = $options['bucket'];
        $prefix = $options['prefix'];

        if (!array_key_exists('credentials', $options)) {
            $credentials = [];
            $credentials['key']  = $options['key'];
            $credentials['secret'] = $options['secret'];
            $options['credentials'] = $credentials;
        }

        $client = new S3Client($options);

        return new AwsS3Adapter($client, $bucket, $prefix);
    }
}
