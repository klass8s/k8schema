<?php

declare(strict_types=1);

namespace K8Schema\Api\Batch\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Api\Core\V1\PodTemplateSpec;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\LabelSelector;

/**
 * JobSpec describes how the job execution will look like.
 */
class JobSpec implements JsonSerializable
{
    /**
     * Specifies the duration in seconds relative to the startTime that the job may be
     * continuously active before the system tries to terminate it; value must be
     * positive integer. If a Job is suspended (at creation or through an update), this
     * timer will effectively be stopped and reset when the Job is resumed again.
     */
    private int|null $activeDeadlineSeconds = null;

    /**
     * Specifies the number of retries before marking this job failed. Defaults to 6
     */
    private int|null $backoffLimit = null;

    /**
     * Specifies the limit for the number of retries within an index before marking
     * this index as failed. When enabled the number of failures per index is kept in
     * the pod's batch.kubernetes.io/job-index-failure-count annotation. It can only be
     * set when Job's completionMode=Indexed, and the Pod's restart policy is Never.
     * The field is immutable. This field is beta-level. It can be used when the
     * `JobBackoffLimitPerIndex` feature gate is enabled (enabled by default).
     */
    private int|null $backoffLimitPerIndex = null;

    /**
     * completionMode specifies how Pod completions are tracked. It can be `NonIndexed`
     * (default) or `Indexed`.
     *
     * `NonIndexed` means that the Job is considered complete when there have been
     * .spec.completions successfully completed Pods. Each Pod completion is homologous
     * to each other.
     *
     * `Indexed` means that the Pods of a Job get an associated completion index from 0
     * to (.spec.completions - 1), available in the annotation
     * batch.kubernetes.io/job-completion-index. The Job is considered complete when
     * there is one successfully completed Pod for each index. When value is `Indexed`,
     * .spec.completions must be specified and `.spec.parallelism` must be less than or
     * equal to 10^5. In addition, The Pod name takes the form
     * `$(job-name)-$(index)-$(random-string)`, the Pod hostname takes the form
     * `$(job-name)-$(index)`.
     *
     * More completion modes can be added in the future. If the Job controller observes
     * a mode that it doesn't recognize, which is possible during upgrades due to
     * version skew, the controller skips updates for the Job.
     */
    private string|null $completionMode = null;

    /**
     * Specifies the desired number of successfully finished pods the job should be run
     * with.  Setting to null means that the success of any pod signals the success of
     * all pods, and allows parallelism to have any positive value.  Setting to 1 means
     * that parallelism is limited to 1 and the success of that pod signals the success
     * of the job. More info:
     * https://kubernetes.io/docs/concepts/workloads/controllers/jobs-run-to-completion/
     */
    private int|null $completions = null;

    /**
     * ManagedBy field indicates the controller that manages a Job. The k8s Job
     * controller reconciles jobs which don't have this field at all or the field value
     * is the reserved string `kubernetes.io/job-controller`, but skips reconciling
     * Jobs with a custom value for this field. The value must be a valid
     * domain-prefixed path (e.g. acme.io/foo) - all characters before the first "/"
     * must be a valid subdomain as defined by RFC 1123. All characters trailing the
     * first "/" must be valid HTTP Path characters as defined by RFC 3986. The value
     * cannot exceed 63 characters. This field is immutable.
     *
     * This field is beta-level. The job controller accepts setting the field when the
     * feature gate JobManagedBy is enabled (enabled by default).
     */
    private string|null $managedBy = null;

    /**
     * manualSelector controls generation of pod labels and pod selectors. Leave
     * `manualSelector` unset unless you are certain what you are doing. When false or
     * unset, the system pick labels unique to this job and appends those labels to the
     * pod template.  When true, the user is responsible for picking unique labels and
     * specifying the selector.  Failure to pick a unique label may cause this and
     * other jobs to not function correctly.  However, You may see
     * `manualSelector=true` in jobs that were created with the old
     * `extensions/v1beta1` API. More info:
     * https://kubernetes.io/docs/concepts/workloads/controllers/jobs-run-to-completion/#specifying-your-own-pod-selector
     */
    private bool|null $manualSelector = null;

    /**
     * Specifies the maximal number of failed indexes before marking the Job as failed,
     * when backoffLimitPerIndex is set. Once the number of failed indexes exceeds this
     * number the entire Job is marked as Failed and its execution is terminated. When
     * left as null the job continues execution of all of its indexes and is marked
     * with the `Complete` Job condition. It can only be specified when
     * backoffLimitPerIndex is set. It can be null or up to completions. It is required
     * and must be less than or equal to 10^4 when is completions greater than 10^5.
     * This field is beta-level. It can be used when the `JobBackoffLimitPerIndex`
     * feature gate is enabled (enabled by default).
     */
    private int|null $maxFailedIndexes = null;

    /**
     * Specifies the maximum desired number of pods the job should run at any given
     * time. The actual number of pods running in steady state will be less than this
     * number when ((.spec.completions - .status.successful) < .spec.parallelism), i.e.
     * when the work left to do is less than max parallelism. More info:
     * https://kubernetes.io/docs/concepts/workloads/controllers/jobs-run-to-completion/
     */
    private int|null $parallelism = null;

    /**
     * Specifies the policy of handling failed pods. In particular, it allows to
     * specify the set of actions and conditions which need to be satisfied to take the
     * associated action. If empty, the default behaviour applies - the counter of
     * failed pods, represented by the jobs's .status.failed field, is incremented and
     * it is checked against the backoffLimit. This field cannot be used in combination
     * with restartPolicy=OnFailure.
     */
    private PodFailurePolicy|null $podFailurePolicy = null;

    /**
     * podReplacementPolicy specifies when to create replacement Pods. Possible values
     * are: - TerminatingOrFailed means that we recreate pods
     *   when they are terminating (has a metadata.deletionTimestamp) or failed.
     * - Failed means to wait until a previously created Pod is fully terminated (has
     * phase
     *   Failed or Succeeded) before creating a replacement Pod.
     *
     * When using podFailurePolicy, Failed is the the only allowed value.
     * TerminatingOrFailed and Failed are allowed values when podFailurePolicy is not
     * in use. This is an beta field. To use this, enable the JobPodReplacementPolicy
     * feature toggle. This is on by default.
     */
    private string|null $podReplacementPolicy = null;

    /**
     * A label query over pods that should match the pod count. Normally, the system
     * sets this field for you. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/labels/#label-selectors
     */
    private LabelSelector|null $selector = null;

    /**
     * successPolicy specifies the policy when the Job can be declared as succeeded. If
     * empty, the default behavior applies - the Job is declared as succeeded only when
     * the number of succeeded pods equals to the completions. When the field is
     * specified, it must be immutable and works only for the Indexed Jobs. Once the
     * Job meets the SuccessPolicy, the lingering pods are terminated.
     *
     * This field is beta-level. To use this field, you must enable the
     * `JobSuccessPolicy` feature gate (enabled by default).
     */
    private SuccessPolicy|null $successPolicy = null;

    /**
     * suspend specifies whether the Job controller should create Pods or not. If a Job
     * is created with suspend set to true, no Pods are created by the Job controller.
     * If a Job is suspended after creation (i.e. the flag goes from false to true),
     * the Job controller will delete all active Pods associated with this Job. Users
     * must design their workload to gracefully handle this. Suspending a Job will
     * reset the StartTime field of the Job, effectively resetting the
     * ActiveDeadlineSeconds timer too. Defaults to false.
     */
    private bool|null $suspend = null;

    /**
     * Describes the pod that will be created when executing a job. The only allowed
     * template.spec.restartPolicy values are "Never" or "OnFailure". More info:
     * https://kubernetes.io/docs/concepts/workloads/controllers/jobs-run-to-completion/
     */
    private PodTemplateSpec $template;

    /**
     * ttlSecondsAfterFinished limits the lifetime of a Job that has finished execution
     * (either Complete or Failed). If this field is set, ttlSecondsAfterFinished after
     * the Job finishes, it is eligible to be automatically deleted. When the Job is
     * being deleted, its lifecycle guarantees (e.g. finalizers) will be honored. If
     * this field is unset, the Job won't be automatically deleted. If this field is
     * set to zero, the Job becomes eligible to be deleted immediately after it
     * finishes.
     */
    private int|null $ttlSecondsAfterFinished = null;

    public function __construct()
    {
        $this->template = new PodTemplateSpec();
    }

    public function getActiveDeadlineSeconds(): int|null
    {
        return $this->activeDeadlineSeconds;
    }

    public function getBackoffLimit(): int|null
    {
        return $this->backoffLimit;
    }

    public function getBackoffLimitPerIndex(): int|null
    {
        return $this->backoffLimitPerIndex;
    }

    public function getCompletionMode(): string|null
    {
        return $this->completionMode;
    }

    public function getCompletions(): int|null
    {
        return $this->completions;
    }

    public function getManagedBy(): string|null
    {
        return $this->managedBy;
    }

    public function getManualSelector(): bool|null
    {
        return $this->manualSelector;
    }

    public function getMaxFailedIndexes(): int|null
    {
        return $this->maxFailedIndexes;
    }

    public function getParallelism(): int|null
    {
        return $this->parallelism;
    }

    public function getPodFailurePolicy(): PodFailurePolicy|null
    {
        return $this->podFailurePolicy;
    }

    public function getPodReplacementPolicy(): string|null
    {
        return $this->podReplacementPolicy;
    }

    public function getSelector(): LabelSelector|null
    {
        return $this->selector;
    }

    public function getSuccessPolicy(): SuccessPolicy|null
    {
        return $this->successPolicy;
    }

    public function getSuspend(): bool|null
    {
        return $this->suspend;
    }

    public function getTtlSecondsAfterFinished(): int|null
    {
        return $this->ttlSecondsAfterFinished;
    }

    public function podFailurePolicy(): PodFailurePolicy
    {
        return $this->podFailurePolicy ??= new PodFailurePolicy();
    }

    public function selector(): LabelSelector
    {
        return $this->selector ??= new LabelSelector();
    }

    public function setActiveDeadlineSeconds(int $activeDeadlineSeconds): self
    {
        $this->activeDeadlineSeconds = $activeDeadlineSeconds;

        return $this;
    }

    public function setBackoffLimit(int $backoffLimit): self
    {
        $this->backoffLimit = $backoffLimit;

        return $this;
    }

    public function setBackoffLimitPerIndex(int $backoffLimitPerIndex): self
    {
        $this->backoffLimitPerIndex = $backoffLimitPerIndex;

        return $this;
    }

    public function setCompletionMode(string $completionMode): self
    {
        $this->completionMode = $completionMode;

        return $this;
    }

    public function setCompletions(int $completions): self
    {
        $this->completions = $completions;

        return $this;
    }

    public function setManagedBy(string $managedBy): self
    {
        $this->managedBy = $managedBy;

        return $this;
    }

    public function setManualSelector(bool $manualSelector): self
    {
        $this->manualSelector = $manualSelector;

        return $this;
    }

    public function setMaxFailedIndexes(int $maxFailedIndexes): self
    {
        $this->maxFailedIndexes = $maxFailedIndexes;

        return $this;
    }

    public function setParallelism(int $parallelism): self
    {
        $this->parallelism = $parallelism;

        return $this;
    }

    public function setPodFailurePolicy(PodFailurePolicy $podFailurePolicy): self
    {
        $this->podFailurePolicy = $podFailurePolicy;

        return $this;
    }

    public function setPodReplacementPolicy(string $podReplacementPolicy): self
    {
        $this->podReplacementPolicy = $podReplacementPolicy;

        return $this;
    }

    public function setSelector(LabelSelector $selector): self
    {
        $this->selector = $selector;

        return $this;
    }

    public function setSuccessPolicy(SuccessPolicy $successPolicy): self
    {
        $this->successPolicy = $successPolicy;

        return $this;
    }

    public function setSuspend(bool $suspend): self
    {
        $this->suspend = $suspend;

        return $this;
    }

    public function setTemplate(PodTemplateSpec $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function setTtlSecondsAfterFinished(int $ttlSecondsAfterFinished): self
    {
        $this->ttlSecondsAfterFinished = $ttlSecondsAfterFinished;

        return $this;
    }

    public function successPolicy(): SuccessPolicy
    {
        return $this->successPolicy ??= new SuccessPolicy();
    }

    public function template(): PodTemplateSpec
    {
        return $this->template;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'activeDeadlineSeconds' => $this->activeDeadlineSeconds,
            'backoffLimit' => $this->backoffLimit,
            'backoffLimitPerIndex' => $this->backoffLimitPerIndex,
            'completionMode' => $this->completionMode,
            'completions' => $this->completions,
            'managedBy' => $this->managedBy,
            'manualSelector' => $this->manualSelector,
            'maxFailedIndexes' => $this->maxFailedIndexes,
            'parallelism' => $this->parallelism,
            'podFailurePolicy' => $this->podFailurePolicy,
            'podReplacementPolicy' => $this->podReplacementPolicy,
            'selector' => $this->selector,
            'successPolicy' => $this->successPolicy,
            'suspend' => $this->suspend,
            'template' => $this->template,
            'ttlSecondsAfterFinished' => $this->ttlSecondsAfterFinished,
        ]);
    }
}
