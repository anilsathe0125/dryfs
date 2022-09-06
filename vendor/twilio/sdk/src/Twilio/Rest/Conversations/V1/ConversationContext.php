<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Conversations\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Rest\Conversations\V1\Conversation\MessageList;
use Twilio\Rest\Conversations\V1\Conversation\ParticipantList;
use Twilio\Rest\Conversations\V1\Conversation\WebhookList;
use Twilio\Serialize;
use Twilio\Values;
use Twilio\Version;

/**
 * @property ParticipantList $participants
 * @property MessageList $messages
 * @property WebhookList $webhooks
 * @method \Twilio\Rest\Conversations\V1\Conversation\ParticipantContext participants(string $sid)
 * @method \Twilio\Rest\Conversations\V1\Conversation\MessageContext messages(string $sid)
 * @method \Twilio\Rest\Conversations\V1\Conversation\WebhookContext webhooks(string $sid)
 */
class ConversationContext extends InstanceContext {
    protected $_participants;
    protected $_messages;
    protected $_webhooks;

    /**
     * Initialize the ConversationContext
     *
     * @param Version $version Version that contains the resource
     * @param string $sid A 34 character string that uniquely identifies this
     *                    resource.
     */
    public function __construct(Version $version, $sid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['sid' => $sid, ];

        $this->uri = '/Conversations/' . \rawurlencode($sid) . '';
    }

    /**
     * Update the ConversationInstance
     *
     * @param array|Options $options Optional Arguments
     * @return ConversationInstance Updated ConversationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []): ConversationInstance {
        $options = new Values($options);

        $data = Values::of([
            'FriendlyName' => $options['friendlyName'],
            'DateCreated' => Serialize::iso8601DateTime($options['dateCreated']),
            'DateUpdated' => Serialize::iso8601DateTime($options['dateUpdated']),
            'Attributes' => $options['attributes'],
            'MessagingServiceSid' => $options['messagingServiceSid'],
            'State' => $options['state'],
            'Timers.Inactive' => $options['timersInactive'],
            'Timers.Closed' => $options['timersClosed'],
            'UniqueName' => $options['uniqueName'],
        ]);
        $headers = Values::of(['X-Twilio-Webhook-Enabled' => $options['xTwilioWebhookEnabled'], ]);

        $payload = $this->version->update('POST', $this->uri, [], $data, $headers);

        return new ConversationInstance($this->version, $payload, $this->solution['sid']);
    }

    /**
     * Delete the ConversationInstance
     *
     * @param array|Options $options Optional Arguments
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(array $options = []): bool {
        $options = new Values($options);

        $headers = Values::of(['X-Twilio-Webhook-Enabled' => $options['xTwilioWebhookEnabled'], ]);

        return $this->version->delete('DELETE', $this->uri, [], [], $headers);
    }

    /**
     * Fetch the ConversationInstance
     *
     * @return ConversationInstance Fetched ConversationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): ConversationInstance {
        $payload = $this->version->fetch('GET', $this->uri);

        return new ConversationInstance($this->version, $payload, $this->solution['sid']);
    }

    /**
     * Access the participants
     */
    protected function getParticipants(): ParticipantList {
        if (!$this->_participants) {
            $this->_participants = new ParticipantList($this->version, $this->solution['sid']);
        }

        return $this->_participants;
    }

    /**
     * Access the messages
     */
    protected function getMessages(): MessageList {
        if (!$this->_messages) {
            $this->_messages = new MessageList($this->version, $this->solution['sid']);
        }

        return $this->_messages;
    }

    /**
     * Access the webhooks
     */
    protected function getWebhooks(): WebhookList {
        if (!$this->_webhooks) {
            $this->_webhooks = new WebhookList($this->version, $this->solution['sid']);
        }

        return $this->_webhooks;
    }

    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return ListResource The requested subresource
     * @throws TwilioException For unknown subresources
     */
    public function __get(string $name): ListResource {
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call(string $name, array $arguments): InstanceContext {
        $property = $this->$name;
        if (\method_exists($property, 'getContext')) {
            return \call_user_func_array(array($property, 'getContext'), $arguments);
        }

        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Conversations.V1.ConversationContext ' . \implode(' ', $context) . ']';
    }
}