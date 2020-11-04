from twisted.internet.defer import inlineCallbacks
from autobahn.twisted.wamp import ApplicationSession, ApplicationRunner
from autobahn.wamp.types import PublishOptions

class Component(ApplicationSession):

    @inlineCallbacks
    def onJoin(self, details):
        print("session attached")
        yield self.subscribe(self.on_event, 'com.myapp.messagex')
# コントローラにurllibで送る コントローラは127.0.0.1以外遮断
# データはsqlute
    def on_event(self, i):
        print("Got event: {}".format(i))
        pub_options = PublishOptions(
                acknowledge=True,
                exclude_me=True,
                exclude=session_ID//
            )
        self.publish('com.myapp.message',["hello"])
        # self.config.extra for configuration, etc. (see [A])


if __name__ == '__main__':
    url = "ws://127.0.0.1:9090/ws"
    realm = "realm1"
    runner = ApplicationRunner(url, realm)
    runner.run(Component)