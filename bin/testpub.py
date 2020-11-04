from twisted.internet.defer import inlineCallbacks

from autobahn.twisted.util import sleep
from autobahn.twisted.wamp import ApplicationSession, ApplicationRunner


class Component(ApplicationSession):
    """
    An application component that publishes an event every second.
    """

    @inlineCallbacks
    def onJoin(self, details):
        print("session attached")
        counter = 0

        def on_event(self, i):
         print("Got event: {}".format(i))

        self.subscribe(self.on_event,'com.myapp.topic1')
        while True:
            print('backend publishing com.myapp.topic1', counter)
            self.publish('com.myapp.topic1', counter)
            counter += 1
            yield sleep(10)


if __name__ == '__main__':
    url = "ws://127.0.0.1:9090/ws"
    realm = "realm1"
    runner = ApplicationRunner(url, realm)
    runner.run(Component)