from twisted.internet import reactor
from twisted.internet.defer import inlineCallbacks
from autobahn.wamp.types import PublishOptions
from autobahn.twisted.wamp import ApplicationSession, ApplicationRunner


class Component(ApplicationSession):
    """
    An application component that subscribes and receives events, and
    stop after having received 5 events.
    """

    @inlineCallbacks
    def onJoin(self, details):
        print("session attached")
        self.received = 0
        sub = yield self.subscribe(self.on_event, 'com.myapp.topic1')
        print("Subscribed to com.myapp.topic1 with {}".format(sub.id))

    def on_event(self, i):
        print("Got event: {}".format(i))
        self.received += 1
        pub_options = PublishOptions(
                acknowledge=True,
                exclude_me=True
            )
        self.publish('com.myapp.topic1',["aho"],options=pub_options)
        # self.config.extra for configuration, etc. (see [A])

    def onDisconnect(self):
        print("disconnected")
        if reactor.running:
            reactor.stop()


if __name__ == '__main__':
    url = "ws://127.0.0.1:9090/ws"
    realm = "realm1"
    runner = ApplicationRunner(url, realm)
    runner.run(Component)

