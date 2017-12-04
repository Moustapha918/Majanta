classes started by g688614 in D:\dev\apache-tomcat-7.0.64\bin)
2017-12-04 18:06:18:331 DEBUG c.i.Application.logStarting : Running with Spring Boot v1.5.3.RELEASE, Spring v4.3.8.RELEASE
2017-12-04 18:06:18:331 INFO  c.i.Application.logStartupProfileInfo : The following profiles are active: dev
dΘc. 04, 2017 6:06:23 PM org.apache.coyote.AbstractProtocol pause
INFOS: Pausing ProtocolHandler ["http-apr-8080"]
dΘc. 04, 2017 6:06:23 PM org.apache.coyote.AbstractProtocol pause
INFOS: Pausing ProtocolHandler ["ajp-apr-8009"]
dΘc. 04, 2017 6:06:23 PM org.apache.catalina.core.StandardService stopInternal
INFOS: ArrΩt du service Catalina
dΘc. 04, 2017 6:06:23 PM org.apache.catalina.startup.HostConfig deployWARs
GRAVE: Error waiting for multi-thread deployment of WAR files to complete
java.lang.InterruptedException
        at java.util.concurrent.FutureTask.awaitDone(FutureTask.java:404)
        at java.util.concurrent.FutureTask.get(FutureTask.java:191)
        at org.apache.catalina.startup.HostConfig.deployWARs(HostConfig.java:830)
        at org.apache.catalina.startup.HostConfig.deployApps(HostConfig.java:493)
        at org.apache.catalina.startup.HostConfig.check(HostConfig.java:1704)
        at org.apache.catalina.startup.HostConfig.lifecycleEvent(HostConfig.java:333)
        at org.apache.catalina.util.LifecycleSupport.fireLifecycleEvent(LifecycleSupport.java:117)
        at org.apache.catalina.util.LifecycleBase.fireLifecycleEvent(LifecycleBase.java:90)
        at org.apache.catalina.core.ContainerBase.backgroundProcess(ContainerBase.java:1373)
        at org.apache.catalina.core.ContainerBase$ContainerBackgroundProcessor.processChildren(ContainerBase.java:1545)
        at org.apache.catalina.core.ContainerBase$ContainerBackgroundProcessor.processChildren(ContainerBase.java:1555)
        at org.apache.catalina.core.ContainerBase$ContainerBackgroundProcessor.run(ContainerBase.java:1523)
        at java.lang.Thread.run(Thread.java:745)




