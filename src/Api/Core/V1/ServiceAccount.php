<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * ServiceAccount binds together: * a name, understood by users, and perhaps by
 * peripheral systems, for an identity * a principal that can be authenticated and
 * authorized * a set of secrets
 */
class ServiceAccount implements APIResourceInterface
{
    public const string API_VERSION = 'v1';
    public const string KIND = 'ServiceAccount';

    /**
     * AutomountServiceAccountToken indicates whether pods running as this service
     * account should have an API token automatically mounted. Can be overridden at the
     * pod level.
     */
    private bool|null $automountServiceAccountToken = null;

    /**
     * ImagePullSecrets is a list of references to secrets in the same namespace to use
     * for pulling any images in pods that reference this ServiceAccount.
     * ImagePullSecrets are distinct from Secrets because Secrets can be mounted in the
     * pod, but ImagePullSecrets are only accessed by the kubelet. More info:
     * https://kubernetes.io/docs/concepts/containers/images/#specifying-imagepullsecrets-on-a-pod
     */
    private LocalObjectReferenceList $imagePullSecrets;

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta|null $metadata = null;

    /**
     * Secrets is a list of the secrets in the same namespace that pods running using
     * this ServiceAccount are allowed to use. Pods are only limited to this list if
     * this service account has a "kubernetes.io/enforce-mountable-secrets" annotation
     * set to "true". The "kubernetes.io/enforce-mountable-secrets" annotation is
     * deprecated since v1.32. Prefer separate namespaces to isolate access to mounted
     * secrets. This field should not be used to find auto-generated service account
     * token secrets for use outside of pods. Instead, tokens can be requested directly
     * using the TokenRequest API, or service account token secrets can be manually
     * created. More info: https://kubernetes.io/docs/concepts/configuration/secret
     */
    private ObjectReferenceList $secrets;

    public function __construct()
    {
        $this->imagePullSecrets = new LocalObjectReferenceList();
        $this->secrets = new ObjectReferenceList();
    }

    public function getAutomountServiceAccountToken(): bool|null
    {
        return $this->automountServiceAccountToken;
    }

    public function imagePullSecrets(): LocalObjectReferenceList
    {
        return $this->imagePullSecrets;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata ??= new ObjectMeta();
    }

    public function secrets(): ObjectReferenceList
    {
        return $this->secrets;
    }

    public function setAutomountServiceAccountToken(bool $automountServiceAccountToken): self
    {
        $this->automountServiceAccountToken = $automountServiceAccountToken;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'automountServiceAccountToken' => $this->automountServiceAccountToken,
            'imagePullSecrets' => $this->imagePullSecrets,
            'metadata' => $this->metadata,
            'secrets' => $this->secrets,
        ]);
    }
}
